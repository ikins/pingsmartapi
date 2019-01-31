<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Tanggal') ?>

    <?= $form->field($model, 'MemberId') ?>

    <?= $form->field($model, 'InvNo') ?>

    <?= $form->field($model, 'Jumlah') ?>

    <?php // echo $form->field($model, 'IdPay') ?>

    <?php // echo $form->field($model, 'IdStat') ?>

    <?php // echo $form->field($model, 'IdBank') ?>

    <?php // echo $form->field($model, 'BankAsal') ?>

    <?php // echo $form->field($model, 'RekeningAsal') ?>

    <?php // echo $form->field($model, 'NamaRekAsal') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <?php // echo $form->field($model, 'Attachment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
