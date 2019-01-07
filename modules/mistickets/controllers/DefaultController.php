<?php

namespace app\modules\mistickets\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\modules\areaclientes\models\Ticket;
use app\modules\areaclientes\models\TicketHistorial;
use app\modules\monitoreo\models\User;
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
       $ot = Yii::$app->getRequest()->getQueryParam('ot');
       //var_dump($ot);
      $ticket = Ticket::find()->where(['ot' => $ot])->one();
     \Yii::$app->getView()->registerJsFile(\Yii::$app->request->BaseUrl . '/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
     // var_dump($ticket);
     return $this->render('ver', array('ticket' => $ticket));
       
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
}
