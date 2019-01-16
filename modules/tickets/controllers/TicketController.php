<?php

namespace app\modules\tickets\controllers;

use yii\web\Controller;
use yii\web\Response;
use app\modules\areaclientes\models\Ticket;
use app\modules\areaclientes\models\TicketHistorial;
use app\modules\monitoreo\models\User;
use kartik\mpdf\Pdf;
//use app\modules\monitoreo\models;

use app\notifications\TicketNotification;


/**
 * Default controller for the `tickets` module
 */
class TicketController extends Controller
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
    const FINALIZADO = 10;

    public function actionIndex()
    {
        $tickets = Ticket::find()->all();
        // \Yii::$app->getView()->registerJsFile(\Yii::$app->request->BaseUrl . '/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
       
        return $this->render('index',array('tickets' => $tickets));
    }


    public function actionFinalizar(){

        $ot = \Yii::$app->getRequest()->getQueryParam('ot');
        $ticket = Ticket::find()->where(['ot' => $ot ])->one();
        //var_dump($tecnico);
        if(is_null($ticket)){
              throw new \yii\web\HttpException(404,'La pagina que buscaba no existe.');
        }
        $equipo = $ticket->getImpresora()->one();
        $tecnico = $ticket->getTecnico0();
    	return $this->render('finalizar',array('ticket' => $ticket,'equipo' => $equipo, 'tecnico' => $tecnico ));
    }

    public function actionFinalizarTicketAjax(){

        $fecha = date('Y-m-d H:i:s');
        $ot = trim($_POST['ot']);
        $firma = trim($_POST['hiddenSigData']);
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);

        $ticket = Ticket::find()->where(['ot' => $ot ])->one();
        if(is_null($ticket)){
              throw new \yii\web\HttpException(404,'La pagina que buscaba no existe.');
        }
        $his = new TicketHistorial();
        $his->ticket_id = $ticket->id;
        $his->estado_id = 10;
        $his->fecha = $fecha;
        $his->user_id =  \Yii::$app->user->identity->id;
        if(!$his->save()){
            return $this->asJson(array('ok' => $enviado, 'link' => 'link', 'error' => 'NO SE PUDO FINALIZAR EL TICKET'));
        }
        $equipo = $ticket->getImpresora()->one();
        $tecnico = $ticket->getTecnico0();
        $user = User::find()->where(['id' => \Yii::$app->user->identity->id])->one();
        $content = $this->renderPartial('_reportView',array('ticket' => $ticket, 'firma' => $firma, 'email' => $email, 'nombre' => $nombre, 'user' => $user));

        $pdf_path = \Yii::getAlias('@app').'\files\tickets\comprobantes\comp-'.$ticket->ot.'.pdf';
        $pdf = new Pdf([
                            // set to use core fonts only
                            'mode' => Pdf::MODE_CORE, 
                            // A4 paper format
                            'format' => Pdf::FORMAT_A4, 
                            // portrait orientation
                            'orientation' => Pdf::ORIENT_PORTRAIT, 
                            // stream to browser inline
                            'destination' => Pdf::DEST_FILE, 
                            // your html content input
                            'content' => $content,  
                            //'filename' => 'comp-'.$ticket->ot,
                            //
                            'filename' => $pdf_path,
                            // //
                            // 'tempPath' => '@app/runtime/mpdf',
                            // format content from your own css file if needed or use the
                            // enhanced bootstrap css built by Krajee for mPDF formatting 
                            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.css',
                            // any css to be embedded if required
                            'cssInline' => '.kv-heading-1{font-size:18px}', 
                             // set mPDF properties on the fly
                            'options' => ['title' => 'Comprobante de ticket finalizado - KROPSYS LTDA'],
                             // call mPDF methods on the fly
                            'methods' => [ 
                                'SetHeader'=>['Comprobante de ticket finalizado - KROPSYS LTDA'], 
                                'SetFooter'=>['{PAGENO}'],
                            ]
    ]);

        $output = $pdf->render(); 
    
    // return the pdf output as per the destination setting
        $message = \Yii::$app->mailer->compose()->setFrom('soporte@kropsys.cl');
        $message->setTo($email)
        ->setSubject('Kropsys cierre de ticket ['.$ot.']')
        ->setTextBody('Plain text cont')
        ->setHtmlBody('<h3>Estimado cliente.</h3><p>El ticket de soporte ['.$ot.'] ha sido cerrado correctamente</p>
            <p>Adjuntamos un comprobante con el detalle</p>
            ');
        $message->attach($pdf_path);
        $enviado = $message->send();


        //agregar link para visitar el correo
        return $this->asJson(array('ok' => $enviado, 'link' => 'link'));


    }






}
