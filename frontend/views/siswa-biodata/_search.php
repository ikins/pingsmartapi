<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaBiodataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-biodata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'NIS') ?>

    <?= $form->field($model, 'Nama') ?>

    <?= $form->field($model, 'JK') ?>

    <?= $form->field($model, 'KotaLahir') ?>

    <?php // echo $form->field($model, 'TglLahir') ?>

    <?php // echo $form->field($model, 'IdAgm') ?>

    <?php // echo $form->field($model, 'idGoldar') ?>

    <?php // echo $form->field($model, 'Alamat') ?>

    <?php // echo $form->field($model, 'Kota') ?>

    <?php // echo $form->field($model, 'Telepon') ?>

    <?php // echo $form->field($model, 'HP') ?>

    <?php // echo $form->field($model, 'IdKab') ?>

    <?php // echo $form->field($model, 'IdProv') ?>

    <?php // echo $form->field($model, 'Pos') ?>

    <?php // echo $form->field($model, 'IdDom') ?>

    <?php // echo $form->field($model, 'AlamatDom') ?>

    <?php // echo $form->field($model, 'KotaDom') ?>

    <?php // echo $form->field($model, 'IdKabDom') ?>

    <?php // echo $form->field($model, 'IdProvDom') ?>

    <?php // echo $form->field($model, 'TeleponDom') ?>

    <?php // echo $form->field($model, 'Foto') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
