<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\BidangStudi;

/* @var $this yii\web\View */
/* @var $model common\models\ProgramStudi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-studi-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class='box box-widget'>
      <div class='box-header hith-border'>
        <h1><?= $this->title;?></h1>
      </div>
      <div class='box-body'>

        <div class='row'>
          <div class='col-sm-7'>
            <div class='row'>
              <div class='col-sm-3 label-div'>
                Program Studi
              </div>
              <div class='col-sm-9'>
                <div class='row'>
                  <div class='col-sm-10'>
                    <?= $form->field($model, 'ProgramStudi')->textInput(['maxlength' => true])->label(false) ?>
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
                    <?= $form->field($model, 'IdBidang')->dropDownList(ArrayHelper::map(BidangStudi::find()->all(), 'Id', 'Bidang'),[
     									'prompt'=>'- Pilih Bidang -'])->label(false)?>
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
