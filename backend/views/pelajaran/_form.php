<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\PelajaranGroup;

/* @var $this yii\web\View */
/* @var $model common\models\Pelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelajaran-form">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class='box box-widget'>
      <div class='box-header with-border'>
        <h1><?= $this->title;?></h1>
      </div>
      <div class='box-body'>

        <div class='row'>
          <div class='col-sm-7'>
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
          <div class='col-sm-7'>
            <div class='row'>
              <div class='col-sm-3 label-div'>
                Pelajaran
              </div>
              <div class='col-sm-9'>
                <div class='row'>
                  <div class='col-sm-10'>
                    <?= $form->field($model, 'Pelajaran')->textInput(['maxlength' => true])->label(false) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class='col-sm-7'>
            <div class='row'>
              <div class='col-sm-3 label-div'>
                Group
              </div>
              <div class='col-sm-9'>
                <div class='row'>
                  <div class='col-sm-10'>
                    <?= $form->field($model, 'IdGroup')->dropDownList(ArrayHelper::map(PelajaranGroup::find()->all(), 'Id', 'Group'),[
     									'prompt'=>'- Pilih Group -'])->label(false)?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class='col-sm-7'>
            <div class='row'>
              <div class='col-sm-3 label-div'>
                Keterangan
              </div>
              <div class='col-sm-9'>
                <div class='row'>
                  <div class='col-sm-10'>
                    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true])->label(false) ?>
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
