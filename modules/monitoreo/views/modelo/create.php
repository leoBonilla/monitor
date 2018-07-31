<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\monitoreo\models\Modelo */

$this->title = 'Nuevo modelo de impresora';
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12" >
<div class="modelo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'marcas' => $marcas
    ]) ?>

</div>
</div>
