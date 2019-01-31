<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Jabatan;
use common\models\Provinsi;
use common\models\Kabupaten;
use common\models\Agama;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\datecontrol\DateControl;
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
		
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
			</h1>
		</div>
		<div class='box-body'>
			<div class='row'>
				<div class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							NIP
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'NIP')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Gelar Depan
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-4'>
									<?= $form->field($data, 'GelarDepan')->textInput(['maxlength' => true])->label(false) ?>
								</div>
								<div class='col-sm-3 label-div'>
									Gelar Belakang
								</div>
								<div class='col-sm-5'>
									<?= $form->field($data, 'GelarBelakang')->textInput(['maxlength' => true])->label(false) ?>
								</div>
							</div>
							
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Nama
						</div>
						<div class='col-sm-9'>
							<?= $form->field($data, 'Nama')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Jabatan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdJab')->dropDownList(ArrayHelper::map(Jabatan::find()->all(), 'Id', 'Jabatan'),['prompt'=>'- Pilih Jabatan -'])->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Alamat
						</div>
						<div class='col-sm-9'>
							<?= $form->field($data, 'Alamat')->textArea(['rows' => 2])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kota
						</div>
						<div class='col-sm-9'>
							<?= $form->field($data, 'Kota')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Provinsi
						</div>
						<div class='col-sm-9'>
							<?= $form->field($data,'IdProv')->dropDownList(ArrayHelper::map(Provinsi::find()->orderBy('Provinsi')->all(),'Id','Provinsi'),[
								'prompt'=>'- Pilih Provinsi -',
								'onchange'=>'
										$.get("'.Url::toRoute('kabupaten/find-by-prov').'",{ id: $(this).val() }).done(function( data ) 
										{
											  $("select#pegawaibiodata-idkab" ).html( data );
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
							<?= $form->field($data, 'IdKab')->dropDownList(ArrayHelper::map(Kabupaten::find()->all(), 'Id', 'Kabupaten'),[
									'prompt'=>'- Pilih Kabupaten -'])->label(false)?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Telepon
						</div>
						<div class='col-sm-9'>
							<?= $form->field($data, 'Telepon')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							HP
						</div>
						<div class='col-sm-9'>
							<?= $form->field($data, 'HP')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
										
				</div>
				<div class='col-sm-6'>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Tempat & Tanggal Lahir
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-7'>
									<?= $form->field($data, 'KotaLahir')->textInput(['maxlength' => true])->label(false) ?>
								</div>
								<div class='col-sm-5'>
									<?= $form->field($data, 'TglLahir')->widget(DateControl::classname(), [
											'type'=>DateControl::FORMAT_DATE,
											'options' => [
												'options' => ['placeholder' => 'Tanggal'],
												'removeButton' => false,
												'pluginOptions' => [
													'autoclose' => true,
													'todayHighlight' => true,
												]
											]
											])->label(false);?>
								</div>
								
							</div>
							 
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Agama
						</div>
						<div class='col-sm-9'>
							<?= $form->field($data, 'IdAgm')->dropDownList(ArrayHelper::map(Agama::find()->all(), 'Id', 'Agama'),['prompt'=>'- Pilih Agama -'])->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Foto
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($data, 'Foto')->widget(FileInput::classname(), [
								'options' => ['accept' => 'Foto/*'],
								'pluginOptions'=>[
									'allowedFileExtensions'=>['jpg','jpeg','gif','png'],
									'initialPreview' =>Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$data->Foto,['class' => 'img img-responsive img-pass-fix-height']),
									]])->label(false);?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Catatan
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($data, 'Keterangan')->textArea(['rows' => 3])->label(false) ?>
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
