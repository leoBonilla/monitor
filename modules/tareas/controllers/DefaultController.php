<?php

namespace app\modules\tareas\controllers;

use yii\web\Controller;
use Yii;
use yii\web\Response;
use yii\data\Pagination;
use app\modules\monitoreo\models\User;
use app\modules\tareas\models\GmailMessage;
//use Google\Client;
ini_set('max_execution_time', '100');

/**
 * Default controller for the `tareas` module
 */
class DefaultController extends Controller
{


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
         $tasks = GmailMessage::find()->where('id >= 1');
         $users = User::find()->all();
           
         $countQuery = clone $tasks;
         $pages = new Pagination(['totalCount' => $countQuery->count()]);
         $models = $tasks->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        return $this->render('tasks', [
         'tasks' => $models,
         'pages' => $pages,
         'users' => $users
            ]);
        
    }

    public function actionAsign(){
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        if($request->isAjax){
            echo json_encode(["success"=> true]);
        }
    }




}
