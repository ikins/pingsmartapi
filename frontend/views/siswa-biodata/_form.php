<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaBiodata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-biodata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KotaLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TglLahir')->textInput() ?>

    <?= $form->field($model, 'IdAgm')->textInput() ?>

    <?= $form->field($model, 'idGoldar')->textInput() ?>

    <?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdKab')->textInput() ?>

    <?= $form->field($model, 'IdProv')->textInput() ?>

    <?= $form->field($model, 'Pos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdDom')->textInput() ?>

    <?= $form->field($model, 'AlamatDom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KotaDom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdKabDom')->textInput() ?>

    <?= $form->field($model, 'IdProvDom')->textInput() ?>

    <?= $form->field($model, 'TeleponDom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
