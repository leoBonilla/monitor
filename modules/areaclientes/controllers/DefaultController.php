<?php

namespace app\modules\areaclientes\controllers;

use yii\web\Controller;
use app\modules\monitoreo\models\Centro;
use app\modules\monitoreo\models\Impresoras;
use app\modules\monitoreo\models\Marca;
use app\modules\monitoreo\models\Modelo;
use app\modules\areaclientes\models\Ticket;
use app\modules\areaclientes\models\TicketHistorial;
use app\modules\areaclientes\models\Tipo;
use app\modules\tickets\models\TicketMensaje;

use Yii;
use yii\web\Response;
use DateTime;
use yii\helpers\Url;
use Aws\S3\S3Client;
/**
 * Default controller for the `areaclientes` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $centros = Centro::find()->all();
    	$this->layout = '../layouts/main';
    	//var_dump($centros);
        return $this->render('index',array('centros' => $centros));
    }

    public function actionCheckSerial(){
         // echo 'cool';
         $request = Yii::$app->request;
         $serial =strtoupper($_POST['serial']);
         // var_dump($request);
         // echo 'cool';
         if($request->isAjax){
            $exists = Impresoras::find()->where(['serie' => $serial])->exists();
            if($exists){
                $imp= Impresoras::find()->where(['serie' => $serial])->one();

                $centro = $imp->getCentroCosto()->one();
                         return $this->asJson(array('existe' =>Impresoras::find()->where(['serie' => $serial])->exists() , 'centro' => $centro->nom_cc, 'impresora'=> $imp));
            }
             return $this->asJson(array('existe' => false , 'centro' =>false));
            


         }

    }


   public function actionGenerarTicket(){
         $request = Yii::$app->request;
         $centros = Centro::find()->all();
         $device = Yii::$app->getRequest()->getQueryParam('device');
        if(!$request->isAjax){
            $this->layout = '../layouts/main';
        //var_dump($centros);
        
         if(isset($device)){
            if(Impresoras::find()->where(['serie' => $device])->exists()){
                $asunto = Yii::$app->db->createCommand("select distinct asunto from ticket ")->queryAll();
                return $this->render('generar',array('dispositivo' => Impresoras::find()->where(['serie' => $device])->one(), 'asunto' => $asunto));
            }else{
                    return $this->render('device_not_found');
            }
            
         }
         else{
             throw new \yii\web\HttpException(404,'La pagina que buscaba no existe.');
         }
        }else
        { 
            if(!$this->is_valid_email($_POST['email'])){
            return false;
            }

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
            $ticket->impresora_id = $_POST['printer_id'];
            $ticket->fuente = 'WEB';
            if($ticket->save()){
                   $historial = new TicketHistorial();
                   $historial->ticket_id = $ticket->id;
                   $historial->estado_id = 1;
                   $historial->user_id = null;
                   $historial->fecha = $fecha;
                   $historial->save();
                   $asunto = Tipo::find()->where(['id' => $ticket->asunto])->one()->tipo;
                   if(!empty($_FILES)){
                            $count = 0;
                            $urls = array();
                            foreach ($_FILES['adjuntos']['name'] as $file) {
                                $path_parts = pathinfo($_FILES['adjuntos']["name"][$count]);
                                $filename = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
                                $stream = fopen($_FILES['adjuntos']['tmp_name'][$count], 'r+');
                                 if(Yii::$app->fs->writeStream($filename, $stream)){
                                  $urls[] = $filename;
                                 }
                                $count++;
                            }
                            $ticket->files = implode(",", $urls);
                            $ticket->save();
                          }
                   $this->notificarCorreo(array(            
                        'ot' => $ticket->ot,
                        'asunto' => $asunto,
                        'contacto' => $ticket->nombre,
                        'email' => $ticket->correo,
                        'imp_id' => $ticket->impresora_id,
                        'fecha' => $ticket->fecha,
                        'url' => 'http://190.208.16.35/monitor/web/index.php?r=areaclientes/default/ver-ticket&ticket='.$ticket->ot
        ),'ticket_creado');

                    return $this->asJson(array('exito' => true, 'OT' => $ticket->ot));
                
    
            }else{
                return $this->asJson(array('exito' => false, 'OT' => false));
            }
            
        }
        
    }
    

    private function notificarCorreo($data,$layout){
        //$baseurl = Url::base('http');
        \Yii::$app->mailer->htmlLayout = "@app/mail/layouts/html";
        
        
        $ticket = Ticket::find()->where(['ot' => $data['ot']])->one();
        $imp = Impresoras::find()->where(['id' => $data['imp_id']])->one();
        $mod = $imp->getModelo0()->one();
        $marca= $mod->getMarca0()->one();
        if(is_null($ticket) || is_null($imp)){
            return false;
        }
        $data['ubicacion'] = $imp->ubicacion;
        $data['equipo'] = $marca->marca.' '.$mod->modelo;
        $data['serie'] = $imp->serie;

        
         $email = Yii::$app->mailer->compose( [ 'html' => '@app/mail/views/'.$layout ] ,['data' => $data] )->setFrom('soporte@kropsys.cl')
        ->setTo($data['email'])
        ->setSubject('El ticket de soporte #'.$data['ot'].' ha sido abierto ')
        ->send();

    }

    public function actionTestEmail(){
        //$baseurl = Url::base('http');
        \Yii::$app->mailer->htmlLayout = "@app/mail/layouts/html";

        $ticketurl = 'http://190.208.16.35/monitor/web/index.php?r=areaclientes/default/ver-ticket&ticket=';
        $data = array(
            
            'ot' => '4545445',
            'asunto' => 'No imprime',
            'contacto' => 'Don vapo',
            'email' => 'test@gmail.com',
            'equipo' => 'Canon 4r',
            'serie' => 'xxddsdsd',
            'ubicacion' => 'Tome',
            'fecha' => '2018-05-12',
            'url' => $ticketurl
        );
         $email = Yii::$app->mailer->compose( [ 'html' => '@app/mail/views/ticket_creado' ] ,['data' => $data] )->setFrom('soporte@kropsys.cl')
        ->setTo('leobonillab@gmail.com')
        ->setSubject('Esto es una prueba ')
        ->send();
       // var_dump($email);

    }



    public function actionVerTicket(){
    	$request = Yii::$app->request;
    	$ticket = Yii::$app->getRequest()->getQueryParam('ticket');
    	$this->layout = '../layouts/main';
    	 if(isset($ticket)){
    	 if(Ticket::find()->where(['ot' => $ticket])->exists()){
              
              $ticket = ticket::find()->where(['ot' => $ticket])->one();
               $mensajes = TicketMensaje::find()->where(['ticket_id' => $ticket->id])->all();
               $fileUrls = array();
               if($ticket->files != null && $ticket->files != ''){
        ///var_dump($ticket->files);
        $files = explode(',', $ticket->files);
        //var_dump($files);
        
        foreach ($files as $key => $value) {
           $fileUrls[] =  $this->getObjectUrl('kropsysfiles', $value);
        }
      }

              $equipo = $ticket->getImpresora()->one();
              $historial = $ticket->getTicketHistorials()->all();
              $centro = $equipo->getCentroCosto()->one();
              $modelo = $equipo->getModelo0()->one();
              $marca = $modelo->getMarca0()->one();
    	 		return $this->render('ver_ticket',array(
                    'ticket' => $ticket,
                    'historial' => $historial, 
                    'dispositivo' => $equipo,
                    'modelo' => $modelo,
                    'marca' => $marca,
                    'centro' => $centro,
                    'mensajes' => $mensajes,
                    'files' => $fileUrls


                )
            );
    	 	}else{
    	 			return $this->render('device_not_found');
    	 	}
    	 	
    	 }
    	 else{
    	 	 throw new \yii\web\HttpException(404,'La pagina que buscaba no existe.');
    	 }
    }

    public function is_valid_email($str)
    {
       return (false !== strpos($str, "@") && false !== strpos($str, "."));
    }


    public function actionDropdownTipo(){
        $request = Yii::$app->request;
        $grupo = $_POST['tipo'];
        $problemas = Tipo::find()->where(['grupo' => $grupo])->all();
         echo "<option value=''>SELECCIONE UNA OPCION</option>";
        foreach ($problemas as $key => $value) {
            echo "<option value=".$value->id.">".$value->tipo."</option>";
        }
         //var_dump($problemas);
    }

    public function actionDropdownEquipos(){
        $request = Yii::$app->request;
        $centro = $_POST['centro'];
        $equipos = Impresoras::find()->where(['centro_costo' => $centro])->all();
         echo "<option value=''>SELECCIONE UNA OPCION</option>";
        foreach ($equipos as $key => $value) {
            echo "<option value=".$value->id.">".$value->ubicacion.' - '.$value->serie."</option>";
        }


    }
      

      public function actionRevisarTicket(){
        $request = Yii::$app->request;
        if($request->isAjax){
            $ticket = $_POST['ticket'];
            $email = $_POST['email'];
            $ticket = ticket::find()->where(['ot' => $ticket, 'correo' => $email ])->one();
            //var_dump($ticket);
            if(is_object($ticket)){
                $url = 'index.php?r=areaclientes/default/ver-ticket&ticket='.$ticket->ot;
                  return $this->asJson(array('exito' => true, 'url' => $url));
            }else{
                  return $this->asJson(array('exito' => false, 'url' => false));
            }
        }
            
      }


  public function actionResponse(){
    if (Yii::$app->request->post()){
      $mensaje = $_POST['mensaje'];
      $prev=base64_decode($_POST['return-url']);
      $m = new TicketMensaje();
      //var_dump($_POST);
      $m->ticket_id = $_POST['id-ticket'];
      $m->fecha = date( 'Y-m-d H:i:s');
      $m->mensaje = $_POST['mensaje'];
      //$m->user_id =;
      if($m->save()){
        return $this->redirect($prev);
      }
        return $this->redirect($prev);
    }else{

    }
  }




  // public function actionTestFile(){

  //   $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');
  //   $presignedUrl = (string)$request->getUri();
  //   echo $presignedUrl;

  // }

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
