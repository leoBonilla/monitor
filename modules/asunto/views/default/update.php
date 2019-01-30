<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\asunto\models\Tipo */

$this->title = 'Editar Tipo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="col-md-12">
	<div class="tipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>