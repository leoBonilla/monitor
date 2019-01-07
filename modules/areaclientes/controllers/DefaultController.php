<?php

namespace app\modules\areaclientes\controllers;

use yii\web\Controller;
use app\modules\monitoreo\models\Centro;
use app\modules\monitoreo\models\Impresoras;
use app\modules\monitoreo\models\Marca;
use app\modules\monitoreo\models\Modelo;
use app\modules\areaclientes\models\Ticket;
use app\modules\areaclientes\models\TicketHistorial;
use Yii;
use yii\web\Response;
use DateTime;
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
    	 $serial = $_POST['serial'];
    	 // var_dump($request);
    	 // echo 'cool';
         if($request->isAjax){
         	$exists = Impresoras::find()->where(['serie' => $serial])->exists();
            if($exists){
                $centro = Impresoras::find()->where(['serie' => $serial])->one()->getCentroCosto()->one();
                         return $this->asJson(array('existe' =>Impresoras::find()->where(['serie' => $serial])->exists() , 'centro' => $centro->nom_cc));
            }
             return $this->asJson(array('existe' => false , 'centro' =>false));
         	


         }

    }

    public function actionGenerarTicket(){
    	 $request = Yii::$app->request;
    	if(!$request->isAjax){
    		$this->layout = '../layouts/main';
    	//var_dump($centros);
    	 $centros = Centro::find()->all();
    	 $device = Yii::$app->getRequest()->getQueryParam('device');
    	 if(isset($device)){
    	 	if(Impresoras::find()->where(['serie' => $device])->exists()){
    	 		return $this->render('generar',array('dispositivo' => Impresoras::find()->where(['serie' => $device])->one()));
    	 	}else{
    	 			return $this->render('device_not_found');
    	 	}
    	 	
    	 }
    	 else{
    	 	 throw new \yii\web\HttpException(404,'La pagina que buscaba no existe.');
    	 }
    	}else{
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

    		if($ticket->save()){
    			   $historial = new TicketHistorial();
    			   $historial->ticket_id = $ticket->id;
    			   $historial->estado_id = 1;
    			   $historial->user_id = null;
    			   $historial->fecha = $fecha;
    			   $historial->save();
    			   $this->sendOtNumber($ticket->ot,$ticket->asunto,$ticket->correo);
    				return $this->asJson(array('exito' => true, 'OT' => $ticket->ot));
    			
    
    		}else{
    			return $this->asJson(array('exito' => false, 'OT' => false));
    		}
    		
    	}
        
    }
    public  function actionSendTicket(){
    	$this->sendOtNumber('00032');
    }

    private function sendOtNumber($otNumber,$asunto = null, $correo){

    	 Yii::$app->mailer->compose()->setFrom('soporte@kropsys.cl')
        ->setTo($correo)
        ->setSubject('Se ha generado un tiket de soporte ['.$otNumber.']')
        ->setTextBody('Plain text cont')
        ->setHtmlBody('<h3>Estimado cliente.</h3>
					<p>Gracias por contactar a nuestro equipo de soporte.</p>
					<p> Se ha abierto un ticket de soporte para su solicitud. Nuestro equpo técnico lo contactará a la brevedad. Los detalles de su ticket se muestran a continuación.</p>

					<p>Numero de ticket : '.$otNumber.'</p>
					<p>Puede ver el estado de su ticket en cualquier momento a traves de <a href="http://localhost/monitor/web/index.php?r=areaclientes/default/ver-ticket&ticket='.$otNumber.'">Este link</a></p>
        	')
        ->send();
        //  Yii::$app->mailer->compose()->setFrom('soporte@kropsys.cl')
        // ->setTo('jacobiyo.g@gmail.com')
        // ->setSubject('Se ha generado un tiket de soporte ['.$otNumber.']')
        // ->setTextBody('Plain text cont')
        // ->setHtmlBody('<h3>que pasa malulos.</h3>
        //             <p>Son unos chicos muy malulos asi que abrieron un ticket.</p>
        //             <p>vayan a traaajar .</p>

        //             <p>Numero de ticket : '.$otNumber.'</p>
        //             <p>Puede ver el estado de su ticket en cualquier momento a traves de <a href="http://localhost/monitor/web/index.php?r=areaclientes/default/ver-ticket&ticket='.$otNumber.'">Este link</a></p>
        //     ')
        // ->send();
    }


    public function actionVerTicket(){
    	$request = Yii::$app->request;
    	$ticket = Yii::$app->getRequest()->getQueryParam('ticket');
    	$this->layout = '../layouts/main';
    	 if(isset($ticket)){
    	 if(Ticket::find()->where(['ot' => $ticket])->exists()){
              
              $ticket = ticket::find()->where(['ot' => $ticket])->one();
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


}
