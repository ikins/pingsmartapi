<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="user-form">
	<div class='row'>
		<div class='col-sm-6'>
			<div class='box box-warning'>
				<?php $form = ActiveForm::begin(); ?>
				<div class='box-header with-border'>
					<h3><?= $this->title;?></h3>
				</div>
				<div class='box-body'>
					<?= $form->field($model, 'Username')->textInput(['maxlength' => true,'readonly' => true]) ?>
					<?= $form->field($model, 'Password')->passwordInput(['maxlength' => true])->label('Masukan Password Baru') ?>
				</div>
				<div class='box-footer'>
					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
					</div>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
