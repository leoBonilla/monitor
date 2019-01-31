<?php

namespace app\modules\tickets\controllers;

use webvimark\components\BaseController;
use yii\web\Controller;
use yii\web\Response;
use app\modules\areaclientes\models\Ticket;
use app\modules\areaclientes\models\TicketHistorial;
use app\modules\tickets\models\TicketMensaje;
use app\modules\tickets\models\TicketNota;
use app\modules\monitoreo\models\User;
use app\modules\monitoreo\models\Centro;
use app\modules\monitoreo\models\Marca;
use app\modules\monitoreo\models\Modelo;
use app\modules\monitoreo\models\Impresoras;
use app\modules\monitoreo\models\Himpresora;
use app\notifications\TicketNotification;
use app\modules\areaclientes\models\Tipo;
use Aws\S3\S3Client;                                                                                                                             
use Yii;
use DateTime;
use yii\helpers\Url;


/**
 * Default controller for the `tickets` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    const SIN_ASIGNAR = 1;
    const ASIGNADO = 2;
    const REASIGNADO = 3;
    const EN_PROCESO = 4;
    const PENDIENTE = 5;
    const FINALIZADO = 7;

    public function actionIndex()
    {
        $tickets = Ticket::find()->orderBy(['fecha'=>SORT_DESC])->all();
        $centros = Centro::find()->all();
        \Yii::$app->getView()->registerJsFile(\Yii::$app->request->BaseUrl . '/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        //var_dump($centros);
       return $this->render('index',array('tickets' => $tickets, 'centros' => $centros));
    }


    public function actionGetContent(){ 
    	$id = $_POST['id'];
    	$ticket = Ticket::find()->where(['id' => $id ])->one();
    	$users = User::find()->all();
    	  $mensajes = TicketMensaje::find()->where(['ticket_id' => $ticket->id])->all();

     $detalle = Himpresora::find()->where(['id_impresora' => $ticket->impresora_id])->limit(3)->orderBy(['id' => SORT_ASC])->all();
     // var_dump($ticket);
     
    	return $this->renderPartial('get_ticket_content', array('ticket' => $ticket,'mensajes' => $mensajes, 'hist' => $detalle, 'users' => $users));
    }

    public function actionAsignarATecnico(){
    	$id = $_POST['ticket-id'];
    	$tec = $_POST['asignar'];
        $action  = $_POST['action'];
        $ob = $_POST['observacion'];
        switch (strtoupper($action)) {
            case 'ASIGNAR':
                 $action = $this::ASIGNADO;
                break;
            case 'REASIGNAR';
                 $action = $this::REASIGNADO ; 
            default:
                # code...
                break;
        }
    	$user = User::find()->where(['id' => $tec])->one();
        //var_dump($user);
        //return false;
    	$result = false;
        $ticket = Ticket::find()->where(['id' => $id ])->one();

    	
    	 if(is_numeric($tec) && is_numeric($id)){
    	 	$his = new TicketHistorial();
    	 	$his->ticket_id = $id;
    	 	$his->fecha = date( 'Y-m-d H:i:s');
    	 	$his->estado_id = $action;
    	 	$his->user_id = $tec;
            $his->admin_id = \Yii::$app->user->identity->id;
             if(strlen($ob) > 0){  
                    $nota = new TicketNota();
                    $nota->nota = $ob;
                    $nota->user_id = \Yii::$app->user->identity->id;
                    $nota->ticket_id =$id;
                    $nota->fecha_creacion = date( 'Y-m-d H:i:s');
                    $nota->save();
                }
            //return false;
    	 	if($his->save()){
    	 		$result = true;
                $imp = Impresoras::find()->where(['id' => $ticket->impresora_id])->one();
                \Yii::$app->pusher->push( array(''.md5($user->username)),'notificacion' , json_encode(array('mensaje' => 'Nuevo ticket asignado', 'descripcion' => "Se le ha asignado el ticket #".$ticket->ot)));
                $user = User::findOne($tec);
               TicketNotification::create(TicketNotification::KEY_NEW_TICKET, [
                        'user' => $user, 
                        'ticket' => $ticket,
                    ]
                    )->send($user);
                 $asunto = Tipo::find()->where(['id' => $ticket->asunto])->one()->tipo;
                $modelo = $imp->getModelo0()->one();
                $marca = $modelo->getMarca0()->one();
                $this->notificarCorreo(array(
                            'ot' => $ticket->ot,
                            'asunto' => $asunto,
                            'contacto' => $ticket->nombre,
                            'email' => $user->email,
                            'equipo' => $marca->marca.' '.$modelo->modelo,
                            'con_email' => $ticket->correo,
                            'imp_id' => $imp->id, 
                            'ubicacion' => $imp->ubicacion,
                            'fecha' => $ticket->fecha,
                            'url' => $ticketurl = 'http://190.208.16.35/monitor/web/index.php?r=mistickets/default/ver&ot='.$ticket->ot,
                            'subject' => 'Se le ha asignado el ticket #'.$ticket->ot
                    ),'ticket_asignado');
    	 	}
    	 }
        // var_dump(array('success' => $result, 'user' => $user->username,'md5'=> md5($user->username)));
        // return false;

    	return $this->asJson(array('success' => $result, 'user' => $user->username,'md5'=> md5($user->username)));

    }




      public function actionCambiarEstado(){
                $estado = $_POST['estado'];
                $ot = $_POST['ot'];
                $user = \Yii::$app->user->identity->id;
                    $ticket = Ticket::find()->where(['ot' => $ot ])->one();
                    $his = new TicketHistorial();
                    $his->ticket_id = $ticket->id;
                    $his->fecha = date( 'Y-m-d H:i:s');
                    $his->estado_id = $estado;
                    $his->user_id = $user;
                    if($his->save()){
                      return $this->asJson(array('success' => true, 'OT' => $ticket->ot));
                    }

  }


  public function actionCrearTicket(){
    $request = Yii::$app->request;
    if($request->isAjax){
        $ticket = new Ticket();
            $fecha = date('Y-m-d H:i:s');
            $ticket->nombre = $_POST['contacto'];
            $ticket->correo = $_POST['email'];
            $ticket->prioridad = 1;
            $ticket->tipo = $_POST['tipo']; 
            $ticket->numero = $_POST['telefono'];
            $ticket->asunto = $_POST['asunto'];
            $ticket->mensaje = $_POST['detalle'];
            $ticket->fecha = $fecha;
            $ticket->impresora_id = $_POST['equipo'];
            $ticket->fuente = $_POST['fuente'];

            if($ticket->save()){
                   $historial = new TicketHistorial();
                   $historial->ticket_id = $ticket->id;
                   $historial->estado_id = 1;
                   $historial->user_id = null;
                   $historial->fecha = $fecha;
                   $historial->save();
                        $impresora = Impresoras::find()->where(['id' => $ticket->impresora_id])->one();
                        $modelo = $impresora->getModelo0()->one();
                        $marca = $modelo->getMarca0()->one();
             $asunto = Tipo::find()->where(['id' => $ticket->asunto])->one()->tipo;
                    $this->notificarCorreo(array(
                            'ot' => $ticket->ot,
                            'asunto' => $asunto,
                            'contacto' => $ticket->nombre,
                            'email' => $ticket->correo,

                            'equipo' => $marca->marca.' '.$modelo->modelo,
                            'serie' => $impresora->serie,
                            'imp_id' => $_POST['equipo'],
                            'ubicacion' => $impresora->ubicacion,
                            'fecha' => $ticket->fecha,
                            'url' => $ticketurl = 'http://190.208.16.35/monitor/web/index.php?r=areaclientes/default/ver-ticket&ticket='.$ticket->ot,
                            'subject' => 'Se ha creado un ticket'
                    ),'ticket_creado');
                    return $this->asJson(array('success' => true, 'OT' => $ticket->ot));
                    }else{
                       return $this->asJson(array('success' => false));
                    }
    
    }
}

private function notificarCorreo($data, $layout){
        //$baseurl = Url::base('http');
        \Yii::$app->mailer->htmlLayout = "@app/mail/layouts/html";
        
        
        $ticket = Ticket::find()->where(['ot' => $data['ot']])->one();
        $imp = Impresoras::find()->where(['id' => $data['imp_id']])->one();
        $mod = $imp->getModelo0()->one();
        $marca= $mod->getMarca0()->one();
        $data['serie'] = $imp->serie;

        if(is_null($ticket) || is_null($imp)){
            return false;
        }
         $email = Yii::$app->mailer->compose( [ 'html' => '@app/mail/views/'.$layout] ,['data' => $data] )->setFrom('soporte@kropsys.cl')
        ->setTo($data['email'])
        ->setSubject($data['subject'])
        ->send();

    }


 public function actionVerTicket(){
    $ot = Yii::$app->getRequest()->getQueryParam('ot');
       //var_dump($ot);
      $ticket = Ticket::find()->where(['ot' => $ot])->one();
      $fileUrls =array();
      if($ticket->files != null && $ticket->files != ''){
        ///var_dump($ticket->files);
        $files = explode(',', $ticket->files);
        //var_dump($files);
        
        foreach ($files as $key => $value) {
           $fileUrls[] =  $this->getObjectUrl('kropsysfiles', $value);
        }

        //esto es un comentario
      }
      //var_dump($ticket);
     // \Yii::$app->getView()->registerJsFile(\Yii::$app->request->BaseUrl . '/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
      $mensajes = TicketMensaje::find()->where(['ticket_id' => $ticket->id])->all();
      $users = User::find()->all();
      $notas = TicketNota::find()->where(['ticket_id' => $ticket->id])->all();
      $anteriores = Ticket::find()->where(['impresora_id' => $ticket->impresora_id ])->all();

     $detalle = Himpresora::find()->where(['id_impresora' => $ticket->impresora_id])->limit(3)->orderBy(['id' => SORT_ASC])->all();
     // var_dump($ticket);
     // var_dump($anteriores);
    return $this->render('ver_ticket', array('ticket' => $ticket,'mensajes' => $mensajes, 'detalle' => $detalle, 'users' => $users, 'files' =>  $fileUrls, 'notas' => $notas,'anteriores' => $anteriores));
 }

    private function getObjectUrl($bucket,$key){
                $s3Client = new S3Client([ 
                        'region' => 'sa-east-1',
                        'version' => 'latest',
                        'credentials' => [
                            'key'    => 'AKIAJEW7A45GBAOLIM4A',
                            'secret' => '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',
                            ],
                          ]);
          $cmd = $s3Client->getCommand('GetObject', [
                                    'Bucket' => $bucket,
                                    'Key' => $key
                                      ]);
          $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');
          $presignedUrl = (string)$request->getUri();
          return $presignedUrl;
        }


}
