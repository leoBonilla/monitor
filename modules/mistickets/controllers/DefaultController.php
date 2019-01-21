<?php

namespace app\modules\mistickets\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\modules\areaclientes\models\Ticket;
use app\modules\tickets\models\TicketMensaje;
use app\modules\areaclientes\models\TicketHistorial;
use app\modules\monitoreo\models\User;
use app\modules\monitoreo\models\Impresoras;
use app\modules\monitoreo\models\HImpresora;
/**
 * Default controller for the `mistickets` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
 public function actionIndex()
    {
     // $this->layout = '../layouts/main';
        $tickets = Ticket::find()->select('ticket.*, max(ticket_historial.fecha) as fecha_historial, ticket_historial.user_id as user_id , ticket_estado.estado, user.username')
                    ->leftJoin('ticket_historial', 'ticket.id =  ticket_historial.ticket_id')
                    ->leftJoin('ticket_estado', 'ticket_historial.estado_id =  ticket_estado.id')
                    ->leftJoin('user', 'ticket_historial.user_id =  user.id')
                    ->where(['ticket_historial.user_id' => Yii::$app->user->identity->id])
                  ->groupBy('ticket_historial.fecha')
                    ->all();
        // $tickets = Yii::$app->db->createCommand('select t1.*, max(t2.fecha) as fecha_historial, t2.user_id as user_id , t3.estado, t4.username from ticket t1 join ticket_historial t2 on t1.id = t2.ticket_id join ticket_estado t3 on t3.id = t2.estado_id join user t4 on t2.user_id = t4.id and t4.id = '.Yii::$app->user->identity->id.' group by 2')
        //     ->queryAll();
        \Yii::$app->getView()->registerJsFile(\Yii::$app->request->BaseUrl . '/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
       
        return $this->render('index',array('tickets' => $tickets));
    }

  public function actionVer(){
    // $this->layout = '../layouts/main';
    if (Yii::$app->request->post()){
          $ticket = Ticket::find()->where(['ot' => $_POST['ot-ticket'] ])->one();
          $his = new TicketHistorial();
          $his->ticket_id = $ticket->id;
          $his->fecha = date( 'Y-m-d H:i:s');
          $his->estado_id =  $_POST['estado'];
          $his->user_id = \Yii::$app->user->identity->id;
          $prev=base64_decode($_POST['return-url']);
          if(isset($_POST['check1']) && $_POST['check1'] == 'on'){
            $his->observacion = trim($_POST['observacion']);
          }
          if(isset($_POST['check2']) && $_POST['check2'] == 'on'){
            //agregar observacion interna;
           $this->notificarCorreo(array(
            'to' => $ticket->correo,
            'subject' => 'El equipo de soporte kropsys escribio en relacion a su ticket',
            'mensaje' => trim($_POST['mensaje_usuario']),
            'ot' => $ticket->ot,
            'imp_id' => $ticket->impresora_id 
           ),'nuevo_mensaje');
          }
          //var_dump($_POST);

   
          if($his->save()){
             return $this->redirect($prev);
               // return $this->asJson(array('exito' => true, 'OT' => $ticket->ot));
          }
      }
      else{
      $ot = Yii::$app->getRequest()->getQueryParam('ot');
       //var_dump($ot);
      $ticket = Ticket::find()->where(['ot' => $ot])->one();
     \Yii::$app->getView()->registerJsFile(\Yii::$app->request->BaseUrl . '/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
      $mensajes = TicketMensaje::find()->where(['ticket_id' => $ticket->id])->all();

     $detalle = Himpresora::find()->where(['id_impresora' => $ticket->impresora_id])->limit(3)->orderBy(['id' => SORT_ASC])->all();
     // var_dump($ticket);
     return $this->render('ver', array('ticket' => $ticket,'mensajes' => $mensajes, 'hist' => $detalle));
      }

       
  }

  public function actionResponse(){
    if (Yii::$app->request->post()){
      $mensaje = $_POST['mensaje'];
      $prev=base64_decode($_POST['return-url']);
      $m = new TicketMensaje();
      var_dump($_POST);
      $m->ticket_id = $_POST['id-ticket'];
      $m->fecha = date( 'Y-m-d H:i:s');
      $m->mensaje = $_POST['mensaje'];
      $m->user_id = \Yii::$app->user->identity->id;
      if($m->save()){
        return $this->redirect($prev);
      }
        return $this->redirect($prev);
    }else{

    }
  }


  public function actionGetContent(){
      $id = $_POST['id'];
      $ticket = Ticket::find()->where(['id' => $id ])->one();
      $users = User::find()->all();
      //var_dump($ticket);
      return $this->renderPartial('get_ticket_content', array('ticket' => $ticket, 'users' => $users));
    }

  public function actionCambiarEstado(){
    $estado = $_POST['estado'];
    $ot = $_POST['ot'];
    $user = $_POST['user'];
    //$action = $_POST['action'];

    $ticket = Ticket::find()->where(['ot' => $ot ])->one();
    $his = new TicketHistorial();
    $his->ticket_id = $ticket->id;
    $his->fecha = date( 'Y-m-d H:i:s');
    $his->estado_id = $estado;
    $his->user_id = $user;
    if($his->save()){
      return $this->asJson(array('exito' => true, 'OT' => $ticket->ot));
    }

  }



  private function notificarCorreo($data,$layout){
        //$baseurl = Url::base('http');
        \Yii::$app->mailer->htmlLayout = "@app/mail/layouts/html";
        
        $ticketurl = 'http://190.208.16.35/monitor/web/index.php?r=areaclientes/default/ver-ticket&ticket='.$data['ot'];
        $data['url'] = $ticketurl;
        $ticket = Ticket::find()->where(['ot' => $data['ot']])->one();
        $imp = Impresoras::find()->where(['id' => $data['imp_id']])->one();
        $mod = $imp->getModelo0()->one();
        $marca= $mod->getMarca0()->one();
        if(is_null($ticket) || is_null($imp)){
            return false;
        }

         $email = Yii::$app->mailer->compose( [ 'html' => '@app/mail/views/'.$layout ] ,['data' => $data] )->setFrom('soporte@kropsys.cl')
        ->setTo($data['to'])
        ->setSubject($data['subject'])
        ->send();

    }


}
