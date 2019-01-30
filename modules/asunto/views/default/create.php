<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\asunto\models\Tipo */

$this->title = 'Crear Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">	
<div class="tipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


</div>