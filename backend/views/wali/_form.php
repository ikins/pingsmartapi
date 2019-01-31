<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Pekerjaan;
use common\models\Provinsi;
use common\models\Kabupaten;
use yii\helpers\Url;
?>

<div class="wali-form">
	 <?php $form = ActiveForm::begin(); ?>
	<div class='row'>
		<div class='col-md-6'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1><?= Html::encode($this->title);?></h1>
				</div>
				<div class='box-body'>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Nama
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Nama')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						<div class="col-sm-3 label-div">
							Pekerjaan
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($model, 'IdJob')->dropDownList(ArrayHelper::map(Pekerjaan::find()->all(), 'Id', 'Pekerjaan'),[
									'prompt'=>'- Pilih Pekerjaan -'])->label(false)?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Alamat
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Alamat')->textArea(['rows' => 1])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kota
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-7'>
									<?= $form->field($model, 'Kota')->textInput(['maxlength' => true])->label(false) ?>
								</div>
								<div class='col-sm-2 label-div'>
									Pos
								</div>
								<div class='col-sm-3'>
									<?= $form->field($model, 'Pos')->textInput(['maxlength' => true])->label(false) ?>
								</div>
							</div>
							
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Provinsi
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model,'IdProv')->dropDownList(ArrayHelper::map(Provinsi::find()->orderBy('Provinsi')->all(),'Id','Provinsi'),[
								'prompt'=>'- Pilih Provinsi -',
								'onchange'=>'
										$.get("'.Url::toRoute('kabupaten/find-by-prov').'",{ id: $(this).val() }).done(function( data ) 
										{
											  $("select#wali-idkab" ).html( data );
											});
										
									'
								])->label(false);?>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kabupaten
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdKab')->dropDownList(ArrayHelper::map(Kabupaten::find()->all(), 'Id', 'Kabupaten'),['prompt'=>'- Pilih Kabupaten -'])->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Telepon
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-6'>
									<?= $form->field($model, 'Telepon')->textInput(['maxlength' => true])->label(false) ?>
								</div>
								<div class='col-sm-2 label-div'>
									HP
								</div>
								<div class='col-sm-4'>
									<?= $form->field($model, 'HP')->textInput(['maxlength' => true])->label(false) ?>
								</div>
							</div>
							
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Keterangan')->textArea(['rows' => 2])->label(false) ?>
						</div>
					</div>
					
				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
				</div>
			</div>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
