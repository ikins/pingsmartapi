<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PegawaiBiodata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-biodata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IdPeg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GelarDepan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GelarBelakang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdProv')->textInput() ?>

    <?= $form->field($model, 'IdKab')->textInput() ?>

    <?= $form->field($model, 'KotaLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TglLahir')->textInput() ?>

    <?= $form->field($model, 'JK')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'Telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Pos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
