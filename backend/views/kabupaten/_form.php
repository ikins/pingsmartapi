<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kabupaten */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kabupaten-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kabupaten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdProv')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
