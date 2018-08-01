<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\monitoreo\models\Centro */

$this->title = Yii::t('app', 'Crear centro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Centros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12" >
<div class="centro-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
