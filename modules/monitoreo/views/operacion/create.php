<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\monitoreo\models\Incidente */

$this->title = Yii::t('app', 'Create Incidente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incidentes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
