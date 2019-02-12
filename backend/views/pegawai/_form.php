<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Jabatan;
use common\models\Provinsi;
use common\models\Kabupaten;
use common\models\Agama;
use common\models\GolonganDarah;
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
							
						</div>
						<div class='col-sm-9'>
							<div class='alert alert-native-danger hide' id='alert-content'>
								Nomor Induk Pegawai Sudah Terdaftar
							</div>
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
					
					<h4>Hak Akses</h4>
					<hr/>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Username
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($user, 'Username')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Password
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($user, 'Password')->passwordInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Email
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($user, 'Email')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							
						</div>
						<div class='col-sm-9'>
							 <div class='alert alert-info'>
								<strong>Keterangan</strong><br/>
								Username & Password digunakan oleh siswa untuk login kedalam system
							</div>
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
						Golongan Darah
					</div>
					<div class='col-sm-9'>
						 <?= $form->field($data, 'idGoldar')->dropDownList(ArrayHelper::map(GolonganDarah::find()->all(), 'id', 'GolDar'),['prompt'=>'- Pilih -'])->label(false)?>
					</div>
				</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Foto
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($data, 'Foto')->widget(FileInput::classname(), [
								'options' => ['accept' => 'Foto/*'],
								'pluginOptions'=>['allowedFileExtensions'=>['jpg','jpeg','gif','png']]])->label(false);?>
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
			<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
		</div>
	</div>
    
    <?php ActiveForm::end(); ?>

</div>

<?php

$urlInc = Url::to(['/pegawai/checknip']);
$script = <<< JS
	
	function checkNIS(nip){
		$.ajax({
			type: 'POST',
			url: '{$urlInc}',
			data: {nip:nip},
			dataType: 'json',
			success: function (data) {
				if(data == true){
					$('#alert-content').removeClass('hide');
					$(':input[type="submit"]').prop('disabled', true);
				}
				else{
					$('#alert-content').addClass('hide');
					$(':input[type="submit"]').prop('disabled', false);
				}
			}
			
		});
	}
	
	$('#pegawai-nip').keyup(function(){
		checkNIS($('#pegawai-nip').val());
		});
	
JS;
$this->registerJs($script);
?>
