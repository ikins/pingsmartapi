<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="bidang-studi-form">

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
					<?= $form->field($model, 'Bidang')->textInput(['maxlength' => true]) ?>
				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
		</div>
	</div>

    
    <?php ActiveForm::end(); ?>

</div>
