<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaWaliSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-wali-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'NIS') ?>

    <?= $form->field($model, 'IdWali') ?>

    <?= $form->field($model, 'IdFam') ?>

    <?= $form->field($model, 'IsLive') ?>

    <?php // echo $form->field($model, 'Remarks') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
