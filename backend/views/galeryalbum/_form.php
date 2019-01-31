<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use common\models\Member;
?>

<div class="galery-album-form">
	<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<div class='row'>
		<div class='col-sm-6 col-md-4'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					<?= $form->field($model, 'MemberId')->dropDownList(ArrayHelper::map(Member::find()->where(['IdLev' => 6])->all(), 'MemberId', 'Nama'),[
										'prompt'=>'- Pilih Nama -'])->label(false)?>
					<?= $form->field($model, 'Album')->textInput(['maxlength' => true]) ?>
					<?= $form->field($model, 'Cover')->widget(FileInput::classname(), [
								'options' => ['accept' => 'Cover/*'],
								'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]]);?>
				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
