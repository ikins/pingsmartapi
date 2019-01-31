<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GuruAjar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guru-ajar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IdPeg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KodePel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KodeKelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
