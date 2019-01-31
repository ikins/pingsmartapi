<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tanggal')->textInput() ?>

    <?= $form->field($model, 'MemberId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InvNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdPay')->textInput() ?>

    <?= $form->field($model, 'IdStat')->textInput() ?>

    <?= $form->field($model, 'IdBank')->textInput() ?>

    <?= $form->field($model, 'BankAsal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RekeningAsal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NamaRekAsal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Attachment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
