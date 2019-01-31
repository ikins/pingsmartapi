<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KelasAgenda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-agenda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TglAwal')->textInput() ?>

    <?= $form->field($model, 'JamAwal')->textInput() ?>

    <?= $form->field($model, 'TglAkhir')->textInput() ?>

    <?= $form->field($model, 'JamAkhir')->textInput() ?>

    <?= $form->field($model, 'KodeKelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdStat')->textInput() ?>

    <?= $form->field($model, 'IdPeg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
