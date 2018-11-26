<?php

namespace app\modules\dashboard\controllers;
use app\modules\dashboard\models\Notas;
use yii\web\Response;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `dashboard` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	$this->layout = '../layouts/main';
    		$notas = Notas::find()->indexBy('id')->orderBy(['fecha_creacion'=>SORT_DESC])->limit(5)->all();
    	    //var_dump($notas);
        return $this->render('index', array('notas' => $notas));
    }

    public function actionCreatenote(){
    	$request = Yii::$app->request;
      		if($request->isAjax){
      			    Yii::$app->response->format = Response::FORMAT_JSON;
      				$nota_n = new Notas();
      				$nota = $_POST['nota'];
      				$titulo = $_POST['nota_titulo'];
      				$nota_n->titulo = $titulo;
      				$nota_n->nota = $_POST['nota'];
      				$nota_n->user_id = Yii::$app->user->identity->id;
      				$nota_n->fecha_creacion = new \yii\db\Expression('NOW()');
      				if($nota_n->save()){
      					echo json_encode(["result"=> true]);
      				}else{
      					echo json_encode(["result"=> false]);
      				}
      				//return response when excecuted!!!!

      		}
    }
}
