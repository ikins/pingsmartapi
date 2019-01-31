<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pendidikan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pendidikan-form">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class='box box-widget'>
      <div class='box-header with-border'>
        <h1><?= $this->title;?></h1>
      </div>
      <div class='box-body'>

        <div class='row'>
          <div class="col-sm-7">
            <div class='row'>
              <div class='col-sm-3 label-div'>
                Kode
              </div>
              <div class='col-sm-9'>
                <div class='row'>
                  <div class='col-sm-10'>
                    <?= $form->field($model, 'Kode')->textInput(['maxlength' => true])->label(false) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class="col-sm-7">
            <div class='row'>
              <div class='col-sm-3 label-div'>
                Pendidikan
              </div>
              <div class='col-sm-9'>
                <div class='row'>
                  <div class='col-sm-10'>
                    <?= $form->field($model, 'Pendidikan')->textInput(['maxlength' => true])->label(false) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class='box-footer'>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
