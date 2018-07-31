<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\monitoreo\models\Marca */

$this->title = 'Create Marca';
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12" >
<div class="marca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
