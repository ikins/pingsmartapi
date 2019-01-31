<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use common\models\GaleryAlbum;
use common\models\GaleryStatus;
?>

<div class="galery-form">
	<div class='row'>
		<div class='col-sm-6'>
			<div class='box box-default'>
				<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
				<div class='box-header with-border'>
					<h4><?= $this->title;?></h4>
				</div>
				<div class='box-body'>
					
					<?= $form->field($model, 'IdAlb')->dropDownList(ArrayHelper::map(GaleryAlbum::find()->all(), 'Id', 'Album'))->label('Album')?>
					<?= $form->field($model, 'Judul')->textInput(['maxlength' => true]) ?>
					<?= $form->field($model, 'Image')->widget(FileInput::classname(), [
						'options' => ['accept' => 'Image/*'],
						'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]]);
					?>
					<?= $form->field($model, 'Deskripsi')->textArea(['rows' => 3]) ?>
					<?= $form->field($model, 'IdStat')->dropDownList(ArrayHelper::map(GaleryStatus::find()->all(), 'Id', 'Status'))->label('Status')?>
					

					
				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
