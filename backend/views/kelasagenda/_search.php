<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KelasAgendaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-agenda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Judul') ?>

    <?= $form->field($model, 'Deskripsi') ?>

    <?= $form->field($model, 'TglAwal') ?>

    <?= $form->field($model, 'JamAwal') ?>

    <?php // echo $form->field($model, 'TglAkhir') ?>

    <?php // echo $form->field($model, 'JamAkhir') ?>

    <?php // echo $form->field($model, 'KodeKelas') ?>

    <?php // echo $form->field($model, 'NIS') ?>

    <?php // echo $form->field($model, 'IdStat') ?>

    <?php // echo $form->field($model, 'IdPeg') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
