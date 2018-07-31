<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\monitoreo\models\Estado */

$this->title = Yii::t('app', 'Create Estado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
