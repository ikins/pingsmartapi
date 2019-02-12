<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NISN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KodeKelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ThnMasuk')->textInput() ?>

    <?= $form->field($model, 'Point')->textInput() ?>

    <?= $form->field($model, 'Billing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IsActive')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
