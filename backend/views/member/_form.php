<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MemberStatus;
use common\models\MemberLevel;
use kartik\file\FileInput;
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
		
	<div class='row'>
		<div class='col-sm-6 col-md-5'>
			<div class='box box-widget'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kode Member
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'MemberId')->textInput(['maxlength' => true,'readonly' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Nama Member
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Nama')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Status
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdStat')->dropDownList(ArrayHelper::map(MemberStatus::find()->all(), 'Id', 'Status'),[
									'prompt'=>'- Status Member -'])->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Level
						</div>
						<div class='col-sm-9'>
							<span class='form-group form-control'><?= $model->level->Level;?>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-3 label-div'>
							Avatar
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($model, 'Avatar')->widget(FileInput::classname(), [
							'options' => ['accept' => 'Avatar/*'],
							'pluginOptions'=>['allowedFileExtensions'=>['jpg','jpeg','gif','png']]])->label(false);?>
						</div>
					</div>
					
					
				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary pull-right']) ?>
				</div>
			</div>
		</div>
	</div>
	
	
    <?php ActiveForm::end(); ?>

</div>
