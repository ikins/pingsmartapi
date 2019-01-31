<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NilaiDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nilai-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Kode') ?>

    <?= $form->field($model, 'NIS') ?>

    <?= $form->field($model, 'KodePel') ?>

    <?= $form->field($model, 'Nilai') ?>

    <?php // echo $form->field($model, 'Standar') ?>

    <?php // echo $form->field($model, 'IdStat') ?>

    <?php // echo $form->field($model, 'TglInput') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
