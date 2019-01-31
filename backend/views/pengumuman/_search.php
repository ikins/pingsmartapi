<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PengumumanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengumuman-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Tanggal') ?>

    <?= $form->field($model, 'Judul') ?>

    <?= $form->field($model, 'Pengumuman') ?>

    <?= $form->field($model, 'IdTarget') ?>

    <?php // echo $form->field($model, 'IdLev') ?>

    <?php // echo $form->field($model, 'KodeKelas') ?>

    <?php // echo $form->field($model, 'IdStat') ?>

    <?php // echo $form->field($model, 'BeginPublish') ?>

    <?php // echo $form->field($model, 'EndPublish') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
