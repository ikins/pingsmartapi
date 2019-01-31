<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JadwalJenis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwal-jenis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Jenis')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
