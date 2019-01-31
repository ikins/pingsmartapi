<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

use common\models\MemberLevel;
use common\models\PengumumanStatus;
?>

<div class="pengumuman-form">
	
    <?php $form = ActiveForm::begin(); ?>
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
			</h1>
		</div>
		<div class='box-body'>
			<div class='row'>
				<div class='col-sm-8'>
					<?= $form->field($model, 'Judul')->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'Pengumuman')->widget(CKEditor::className(), [
						'options' => ['rows' => 5],
						'preset' => 'basic'
					])->label('Pengumuman') ?>

					<?=	$form->field($model, 'Target[]')->widget(Select2::className(),
							[
								'data'=> common\models\MemberLevel::getOptions(),
								'size' => Select2::SMALL,
								'options' => [
									'tags' => true,
									'multiple' => true
								],
							]
							)->label('Target Audience');
						?>
					
					<?=	$form->field($model, 'KodeKelas[]')->widget(Select2::className(),
							[
								'data'=> common\models\Kelas::getOptions(),
								'size' => Select2::SMALL,
								'options' => [
									'tags' => true,
									'multiple' => true
								],
							]
							)->label('Kelas');
						?>

					
				</div>
				<div class='col-sm-4'>
					<?= $form->field($model, 'IdStat')->dropDownList(ArrayHelper::map(PengumumanStatus::find()->all(), 'Id', 'Status'))->label('Status')?>
					<label>Tanggal Publikasi</label>
					<div class='row'>
						<div class='col-sm-6'>
							<?= $form->field($model, 'BeginPublish')->widget(DateControl::classname(), [
							'type'=>DateControl::FORMAT_DATE,
							'options' => [
								'options' => ['placeholder' => 'Tanggal Awal'],
								'removeButton' => false,
								'pluginOptions' => [
									'autoclose' => true,
									'todayHighlight' => true,
								]
							]
							])->label(false);?>
						</div>
						<div class='col-sm-6'>
							<?= $form->field($model, 'EndPublish')->widget(DateControl::classname(), [
							'type'=>DateControl::FORMAT_DATE,
							'options' => [
								'options' => ['placeholder' => 'Tanggal Akhir'],
								'removeButton' => false,
								'pluginOptions' => [
									'autoclose' => true,
									'todayHighlight' => true,
								]
							]
							])->label(false);?>
						</div>
					</div>
					<?= $form->field($model, 'Keterangan')->textArea(['rows' => 3])->label('Keterangan') ?>
				</div>
			</div>
		</div>
		<div class='box-footer'>
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$dataTarget=($model->Target)?$model->Target:'[""]';
$dataKelas=($model->KodeKelas)?$model->KodeKelas:'[""]';

$script = <<< JS

$('#pengumuman-target').val({$dataTarget}).trigger('change');
$('#pengumuman-kodekelas').val({$dataKelas}).trigger('change');
 
JS;
$this->registerJs($script);
?>
