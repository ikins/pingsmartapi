<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IdentitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="identity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'NPSN') ?>

    <?= $form->field($model, 'Sekolah') ?>

    <?= $form->field($model, 'IdLev') ?>

    <?= $form->field($model, 'IdStat') ?>

    <?php // echo $form->field($model, 'IdCore') ?>

    <?php // echo $form->field($model, 'Alamat') ?>

    <?php // echo $form->field($model, 'Kota') ?>

    <?php // echo $form->field($model, 'IdKab') ?>

    <?php // echo $form->field($model, 'IdProv') ?>

    <?php // echo $form->field($model, 'Telepon') ?>

    <?php // echo $form->field($model, 'HP') ?>

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'Website') ?>

    <?php // echo $form->field($model, 'Logo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
