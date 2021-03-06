<?php

namespace app\modules\monitoreo\controllers;

use yii\web\Controller;
use yii\web\Response;
use app\modules\monitoreo\models\Centro;
use app\modules\monitoreo\models\Marca;
use app\modules\monitoreo\models\Modelo;
use app\modules\monitoreo\models\Impresoras;
use app\modules\monitoreo\models\Himpresora;
use app\modules\monitoreo\models\User;
use app\modules\monitoreo\models\Estado;
use app\modules\monitoreo\models\Ubicacion;
use app\modules\monitoreo\models\Incidente;
use Yii;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxFile;
use app\models\Datatables;
use tpmanc\imagick\Imagick;
/**
 * Default controller for the `monitor` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $imp = Impresoras::find()->where(['deshabilitada' => 0 ])->indexBy('id')->all();
        return $this->render('index', array('imp' => $imp));
    }

    public function actionAgregar(){
    	 $query  = Centro::find()->orderBy('nom_cc')->all();
         $marca  = Marca::find()->orderBy('marca')->all();
         $modelo = Modelo::find()->orderBy('modelo')->all();
          //var_dump($query);
    	return $this->render('agregar',['ccostos' => $query, 'marcas' => $marca, 'modelo' => $modelo]);
    }

    public function actionPrinteradd(){
      $request = Yii::$app->request;
      if($request->isAjax){

          $data = $_POST;
          $imp = new Impresoras();
          $imp->serie = $data['serie'];
          $imp->codigo = $data['codigo'];
          $imp->serie = $data['serie'];
          $imp->modelo = $data['impresora'];
          $imp->centro_costo = $data['centrocosto'];
          $imp->contacto = $data['contacto'];
          $imp->telefono = $data['telefono'];
          $imp->email = $data['email'];
          $imp->observaciones = $data['observacion'];
          $imp->ubicacion = $data['ubicacion'];
          $imp->oficina = $data['oficina'];
          $imp->piso = $data['piso'];
          $imp->deshabilitada = 0;
          $imp->fecha = new \yii\db\Expression('NOW()');

          Yii::$app->response->format = Response::FORMAT_JSON;
           $exists = Impresoras::find()->where( [ 'serie' => $imp->serie ] )->exists();
           $cexists = Impresoras::find()->where( [ 'codigo' => $imp->codigo ] )->exists();
           if(!$exists && !$cexists){
             if($imp->insert()){

                 $u = new Ubicacion();
                 $u->impresora = $imp->id;
                 $u->fecha = new \yii\db\Expression('NOW()');
                 $u->oficina = $data['oficina'];
                 $u->ubicacion = $data['ubicacion'];
                 $u->piso = $data['piso'];
                 if($u->insert()){
                    echo json_encode(["success"=> true]);
                 }else{
                 // var_dump($u->getErrors());
                 }
                
           }else{
                    echo json_encode(["success"=> false]);
                    
           }
         }else{
          $message = null;
             if($exists){
              $message = 'El numero de serie que intenta guardar ya existe';
            }else{
                $message = 'El codigo que intenta guardar ya existe';
            }
            echo json_encode(["success"=> false, "message" => $message]);
         }



      }
    }

    public function actionEditRegisterAjax(){
       $request = Yii::$app->request;
       if($request->isAjax){
          $data = $_POST;
          $h = Himpresora::find()->where(['id' => $data['id']])->one();
          $estados = Estado::find()->indexBy('id')->all();
          $incidentes = Incidente::find()->indexBy('id')->all();
          //var_dump($incidentes);

       }
      return $this->renderPartial('edit_register_ajax', array('h' => $h, 'estados' => $estados, 'incidentes' => $incidentes));  
    }

    public function actionAddhistory(){
          $request = Yii::$app->request;
          if($request->isAjax){
          $data = $_POST;
          $h = new Himpresora();
          $imp = Impresoras::find()->where(['id' => $data['id_impresora']])->one();
          $transaction = Himpresora::getDb()->beginTransaction();

          try {
                    $result = false;
                    //popular objeto historial impresora 
                    $h->estado = $data['estado'];
                    $h->id_incidente = $data['incidente'];
                    $h->id_impresora = $data['id_impresora'];
                    $h->fecha = $data['fecha'];
                    $h->id_tecnico = Yii::$app->user->identity->id;
                    $h->detalle = $data['observaciones'];
                    $h->tipo = $data['tipo'];
                    $h->n_registro = $data['registro'];
                          //obtener el archivo que se envio
                    if(isset($_FILES['file']['tmp_name'])){
                            $tmp_file = $_FILES['file'];
                           // $app = new DropboxApp('zq7qf3skowc3w99', 'lcy6nutbksk53s9', 'gydWhjKJudAAAAAAAAAACdgFS4QPwvRlQaAxK7BXyPc3fHYqZOQAcCrC6p8ZpGP3');
                            //$dropbox = new Dropbox($app);
                            //$dropboxfile = new DropboxFile($tmp_file);
                            //$file = $dropbox->upload($dropboxfile,'/'.$h->n_registro.'-'.$h->id_impresora.'.pdf');
                            $file = $this->uploadFileToDropbox($tmp_file, $h->n_registro, $h->id_impresora);
                            $h->adjunto = $file->getPathDisplay();
                    }else{
                        $h->adjunto = null;
                    }
                    //si es un cambio de ubicacion
                    //var_dump($h);
                    if($data['estado'] == 0 ){
                           //agregar un nuevo historial de ubicacion
                            $u = new Ubicacion();
                            $u->ubicacion = $data['ubicacion'];
                            $u->oficina = $data['oficina'];
                            $u->piso = $data['piso'];                  
                            $u->impresora = $data['id_impresora'];
                            $u->fecha = $data['fecha'];
                            
                            $imp->ubicacion = $data['ubicacion'];
                            $imp->oficina = $data['oficina'];
                            $imp->piso = $data['piso'];
                            $u->insert();
                            $imp->update();
                            $h->insert();
                           
                            $transaction->commit();

                           $result = true;

              }else{

                      $result = $h->insert();
                      $transaction->commit();

              }
              Yii::$app->response->format = Response::FORMAT_JSON;
              echo json_encode(array('success' => $result));

                } catch(\Exception $e) {

                    $transaction->rollBack();
                     throw $e;
                    } catch(\Throwable $e) {

                    $transaction->rollBack();
                    throw $e;
            }

        



      }
    }


    public function actionDetalleprinter(){
      // $app = new DropboxApp('zq7qf3skowc3w99', 'lcy6nutbksk53s9', 'gydWhjKJudAAAAAAAAAACdgFS4QPwvRlQaAxK7BXyPc3fHYqZOQAcCrC6p8ZpGP3');
      // $dropbox = new Dropbox($app);
      // $file = $dropbox->getMetadata("/hello-world.txt");
      // var_dump($file);
       if(isset($_GET['id']) && is_numeric($_GET['id'])){
         $imp = Impresoras::find()->where(['id' => $_GET['id']])->one();
         $estados = Estado::find()->indexBy('id')->all();
         $incidentes = Incidente::find()->indexBy('id')->all();
         $detalle = Himpresora::find()->where(['id_impresora' => $_GET['id']])->all();
         $ubicaciones = Ubicacion::find()->where(['impresora' => $_GET['id']])->all();
          return $this->render('detalle', array('detalle' => $detalle, 'imp' => $imp,'estados' => $estados, 'ubicaciones' => $ubicaciones, 'incidentes' => $incidentes, 'incidentes' => $incidentes));
       }else{

       }
       
    }

    public function actionDetallePrinterAjax(){
         $request = Yii::$app->request;
         if($request->isAjax){
           $data = $_POST;
            $imp =  Impresoras::find()->where(['id' => $data['id']])->one();
            $cc = $imp->getCentroCosto()->one();
            $modelo = $imp->getModelo0()->one();
            $marca = $modelo->getMarca0()->one();

             $detalle = Himpresora::find()->where(['id_impresora' => $data['id']])->limit(3)->orderBy(['id' => SORT_ASC])->all();

           return $this->renderPartial('detalle_ajax', array('imp' => $imp, 'cc' => $cc, 'ma' => $marca, 'mo' =>$modelo, 'detalle' => $detalle));


      }
    }

    public function actionPrinterEditAjax(){
         $request = Yii::$app->request;
         if($request->isAjax){
           $data = $_POST;
             $imp =  Impresoras::find()->where(['id' => $data['id']])->one();
             $query  = Centro::find()->orderBy('nom_cc')->all();
             $marca  = Marca::find()->orderBy('marca')->all();
             $modelo = Modelo::find()->orderBy('modelo')->all();
          //var_dump($query);
        return $this->renderPartial('edit_ajax',['imp' => $imp, 'ccostos' => $query, 'marcas' => $marca, 'modelo' => $modelo]);



      }
    }


    public function actionEditRegister(){
       $request = Yii::$app->request;
       Yii::$app->response->format = Response::FORMAT_JSON;
      if($request->isAjax){
         if(isset($_FILES['file']['tmp_name'])){
                            $tmp_file = $_FILES['file'];
                            $file = $this->uploadFileToDropbox($tmp_file,$_POST['numero'],$_POST['printer_id'], true);

                          }
                            $h = Himpresora::find()->where(['n_registro' => $_POST['numero']])->one();
                            $h->fecha = $_POST['fecha'];
                            $h->n_registro = $_POST['numero'];
                            $h->detalle = $_POST['detalle'];
                            $h->id_incidente = $_POST['operacion'];
                            $h->estado = $_POST['estado'];  
                            $x = $h->update();   
                           // var_dump($x);        
                if ($x !== false) {
                        echo json_encode(["success"=> true ]);
                        } else {
                         echo json_encode(["success"=> false ]);
                        }
                // echo json_encode(["success"=> true]);
                }else{
                echo json_encode(["success"=> false ]);
                }
    }

    private function uploadFileToDropbox($tmp_file, $register, $printer,$update = false){
                $ext = pathinfo($tmp_file['name'], PATHINFO_EXTENSION);
                if($ext == 'jpg'){
                            $img = Imagick::open($tmp_file['tmp_name']);
                            $i = $img->getImage();
                            $i->setImageFormat('pdf');
                            $i->writeImage('/imagen.pdf');
                            
                            //crear un archivo temporal 
                            $temp = tmpfile();
                            fwrite($temp, $i);
                            $tmp_file_data = stream_get_meta_data($temp);
                            $tmp_file_name = $tmp_file_data['uri'];
                }
                if($ext == 'pdf'){
                            $tmp_file_name = $tmp_file['tmp_name'];
                }


                            $app = new DropboxApp('zq7qf3skowc3w99', 'lcy6nutbksk53s9', 'gydWhjKJudAAAAAAAAAACdgFS4QPwvRlQaAxK7BXyPc3fHYqZOQAcCrC6p8ZpGP3');
                            $dropbox = new Dropbox($app);
                            $dropboxfile = new DropboxFile($tmp_file_name);
                            $dropbox_filename = '/'.$register.'-'.$printer.'.pdf';
                            if($update){
                              $deletedFolder = $dropbox->delete($dropbox_filename);
                            }
                            $file = $dropbox->upload($dropboxfile ,$dropbox_filename);
                            return $file;
                            // var_dump($file);
    }


    public function actionPrinterUpdate(){
         $request = Yii::$app->request;
         Yii::$app->response->format = Response::FORMAT_JSON;
         if($request->isAjax){
            $data = $_POST;
            $imp =  Impresoras::find()->where(['id' => $data['id']])->one();
            if($imp){
                $imp->serie = $data['serie'];
                 $imp->codigo = $data['codigo'];
                  $imp->centro_costo = $data['centrocosto'];
                   $imp->contacto = $data['contacto'];
                    $imp->telefono = $data['telefono'];
                     $imp->email = $data['email'];
                      $imp->modelo = $data['impresora'];
                       $imp->observaciones = $data['observacion'];

                if ($imp->update() !== false) {
                        echo json_encode(["success"=> false ]);
                        } else {
                         echo json_encode(["success"=> false ]);
                        }
                // echo json_encode(["success"=> true]);
                }else{
                echo json_encode(["success"=> false ]);
                }
      }
    }

    public function actionDownloadFile(){
       $request = Yii::$app->request;
       $file_name = $_GET['file'];
       header("Content-type:application/pdf");
       //header('Content-Type: application/octet-stream');
          $app = new DropboxApp('zq7qf3skowc3w99', 'lcy6nutbksk53s9', 'gydWhjKJudAAAAAAAAAACdgFS4QPwvRlQaAxK7BXyPc3fHYqZOQAcCrC6p8ZpGP3');
          $dropbox = new Dropbox($app);
          $file = $dropbox->download("/".$file_name);
          //readfile($file);
          $contents = $file->getContents();
          echo $contents;

    }

    public function actionDeleteprinter(){
         $request = Yii::$app->request;
         Yii::$app->response->format = Response::FORMAT_JSON;
         if($request->isAjax){
            $data = $_POST;
            $imp =  Impresoras::find()->where(['id' => $data['id']])->one();
            if($imp){
                $imp->deshabilitada = 1;
                if($imp->update() != false){
                  echo json_encode(["success"=> true]);
                }else{
                   echo json_encode(["success"=> false]);
                }
                // echo json_encode(["success"=> true]);
            }else{
                echo json_encode(["success"=> false ]);
            }
      }
    }


   public function actionPrinterEdit(){
            $request = Yii::$app->request;
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isAjax){
            $data = $_POST;
            $imp =  Impresoras::find()->where(['id' => $data['id']])->one();
            if($imp){
                $imp->serie = $data['serie'];
                $imp->codigo = $data['codigo'];
                //$imp->modelo = $data['impresora']
                $imp->centro_costo = $data['centrocosto'];
                $imp->contacto = $data['contacto'];
                $imp->telefono = $data['telefono'];
                $imp->email = $data['email'];
                $imp->observaciones = $data['observacion'];
                // $imp->ubicacion = $data['ubicacion'];
                // $imp->oficina = $data['oficina'];
                // $imp->piso = $data['piso'];

               if($imp->update() !== false){
                    echo json_encode(["success" => true]);
               }else{
                    echo json_encode(["success"=> false]);
               }

            }else{
                echo json_encode(["success"=> false ]);
            }
      }
   }


   public function actionTesting(){
              phpinfo();
   }








    
}
