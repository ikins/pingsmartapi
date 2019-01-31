<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Identity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="identity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NPSN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sekolah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdLev')->textInput() ?>

    <?= $form->field($model, 'IdStat')->textInput() ?>

    <?= $form->field($model, 'IdCore')->textInput() ?>

    <?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdKab')->textInput() ?>

    <?= $form->field($model, 'IdProv')->textInput() ?>

    <?= $form->field($model, 'Telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Logo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
