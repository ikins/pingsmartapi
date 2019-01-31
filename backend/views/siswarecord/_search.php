<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Tanggal') ?>

    <?= $form->field($model, 'NIS') ?>

    <?= $form->field($model, 'IdPel') ?>

    <?= $form->field($model, 'Point') ?>

    <?php // echo $form->field($model, 'IdPeg') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
