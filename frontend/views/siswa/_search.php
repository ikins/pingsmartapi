<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'NIS') ?>

    <?= $form->field($model, 'NISN') ?>

    <?= $form->field($model, 'KodeKelas') ?>

    <?= $form->field($model, 'MemberId') ?>

    <?php // echo $form->field($model, 'ThnMasuk') ?>

    <?php // echo $form->field($model, 'Point') ?>

    <?php // echo $form->field($model, 'Billing') ?>

    <?php // echo $form->field($model, 'Rangking') ?>

    <?php // echo $form->field($model, 'BestScore') ?>

    <?php // echo $form->field($model, 'BestItem') ?>

    <?php // echo $form->field($model, 'Sakit') ?>

    <?php // echo $form->field($model, 'Izin') ?>

    <?php // echo $form->field($model, 'Alpa') ?>

    <?php // echo $form->field($model, 'IsActive') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
