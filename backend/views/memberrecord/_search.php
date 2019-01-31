<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MemberRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Tanggal') ?>

    <?= $form->field($model, 'MemberId') ?>

    <?= $form->field($model, 'Kode') ?>

    <?= $form->field($model, 'Durasi') ?>

    <?php // echo $form->field($model, 'Harga') ?>

    <?php // echo $form->field($model, 'Expired') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
