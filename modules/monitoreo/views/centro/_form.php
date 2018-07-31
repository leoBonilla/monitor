<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\monitoreo\models\Centro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod_cc')->textInput() ?>

    <?= $form->field($model, 'nom_cc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_cc')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
