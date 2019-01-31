<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MemberRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tanggal')->textInput() ?>

    <?= $form->field($model, 'MemberId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Durasi')->textInput() ?>

    <?= $form->field($model, 'Harga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Expired')->textInput() ?>

    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
