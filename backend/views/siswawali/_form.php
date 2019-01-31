<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaWali */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-wali-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdWali')->textInput() ?>

    <?= $form->field($model, 'IdFam')->textInput() ?>

    <?= $form->field($model, 'IsLive')->textInput() ?>

    <?= $form->field($model, 'Remarks')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
