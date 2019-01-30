<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\asunto\models\Tipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grupo')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
