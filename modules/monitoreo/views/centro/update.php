<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\monitoreo\models\Centro */

$this->title = Yii::t('app', 'Editar Centro: ' . $model->nom_cc, [
    'nameAttribute' => '' . $model->cod_cc,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Centros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cod_cc, 'url' => ['view', 'id' => $model->cod_cc]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="col-md-12" >
<div class="centro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
