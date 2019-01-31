<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Plan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>
	
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
							Kode Paket
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Kode')->textInput(['maxlength' => true,'readonly' => $model->IsNewRecord? false:true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Nama Paket
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Plan')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Durasi
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Durasi')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Harga
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Harga')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true])->label(false) ?>
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
