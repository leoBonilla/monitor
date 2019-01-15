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
class TicketController extends Controller
{
  public function actionIndex(){
    // // $this->layout = '../layouts/main';
    $ot = Yii::$app->getRequest()->getQueryParam('ticket');
    $ticket = Ticket::find()->where(['ot' => $ot ])->one();
    return $this->render('index', array('ticket' => $ticket));
    //var_dump($ticket);
    //    //var_dump($ot);
    //   $ticket = Ticket::find()->where(['ot' => $ot])->one();
    //  \Yii::$app->getView()->registerJsFile(\Yii::$app->request->BaseUrl . '/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    //  // var_dump($ticket);
    //  return $this->render('ver', array('ticket' => $ticket));
       
  }

}