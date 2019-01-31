<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NilaiDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nilai-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KodePel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nilai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Standar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdStat')->textInput() ?>

    <?= $form->field($model, 'TglInput')->textInput() ?>

    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
