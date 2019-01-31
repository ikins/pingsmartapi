<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ProgramStudi;
?>

<div class="kompetensi-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<div class='row'>
		<div class='col-sm-4'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					<?= $form->field($model, 'Kompetensi')->textInput(['maxlength' => true]) ?>
					<?= $form->field($model, 'IdProdi')->dropDownList(ArrayHelper::map(ProgramStudi::find()->all(), 'Id', 'ProgramStudi'),[
										'prompt'=>'- Pilih ProgramStudi -'])->label('Program Studi')?>

				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
