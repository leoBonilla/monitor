<?php

namespace app\modules\tickets\controllers;

use yii\web\Controller;
use yii\web\Response;
use app\modules\areaclientes\models\Ticket;
use app\modules\areaclientes\models\TicketHistorial;
use app\modules\monitoreo\models\User;

use app\notifications\TicketNotification;


/**
 * Default controller for the `tickets` module
 */
class DefaultController extends Controller
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

    public function actionIndex()
    {
        $tickets = Ticket::find()->all();
        \Yii::$app->getView()->registerJsFile(\Yii::$app->request->BaseUrl . '/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
       
        return $this->render('index',array('tickets' => $tickets));
    }


    public function actionGetContent(){
    	$id = $_POST['id'];
    	$ticket = Ticket::find()->where(['id' => $id ])->one();
    	$users = User::find()->all();
    	//var_dump($ticket);
    	return $this->renderPartial('get_ticket_content', array('ticket' => $ticket, 'users' => $users));
    }

    public function actionAsignarATecnico(){
    	$id = $_POST['ticket-id'];
    	$tec = $_POST['asignar'];
        $action  = $_POST['action'];
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
    	$result = false;
        $ticket = Ticket::find()->where(['id' => $id ])->one();

    	
    	 if(is_numeric($tec) && is_numeric($id)){
    	 	$his = new TicketHistorial();
    	 	$his->ticket_id = $id;
    	 	$his->fecha = date( 'Y-m-d H:i:s');
    	 	$his->estado_id = $action;
    	 	$his->user_id = $tec;
    	 	if($his->save()){
    	 		$result = true;
                \Yii::$app->pusher->push( array(''.md5($user->username)),'notificacion' , json_encode(array('mensaje' => 'Nuevo ticket asignado', 'descripcion' => "Se le ha asignado el ticket #".$ticket->ot)));
                //$not->create(TicketNotification::KEY_NEW_TICKET, ['user' => $user])->send();
               TicketNotification::create(TicketNotification::KEY_NEW_TICKET, [
                        'user' => $user, 
                        'ticket' => $ticket]
                    )->send();

               $this->enviarCorreoATecnico($user->email);
    	 	}
    	 }
         
    	return $this->asJson(array('exito' => $result, 'user' => $user->username,'md5'=> md5($user->username)));

    }


    public function enviarCorreoATecnico($email){
         \Yii::$app->mailer->compose()->setFrom('soporte@kropsys.cl')
        ->setTo($email)
        ->setSubject('Se ha generado un tiket de soporte []')
        ->setTextBody('Plain text cont')
        ->setHtmlBody('<h3>Se le ha asignado un nuevo ticket de soporte.</h3>
                    <p></p>
                    
            ')
        ->send();
    }

      public function actionCambiarEstado(){
                $estado = $_POST['estado'];
                $ot = $_POST['ot'];
                $user = \Yii::$app->user->identity->id;
    //             $user = $_POST['user'];
    // //$action = $_POST['action'];

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
}
