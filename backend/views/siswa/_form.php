<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use common\models\Provinsi;
use common\models\Kabupaten;
use common\models\Domisili;
use common\models\Agama;
use common\models\Kelas;
use common\models\GolonganDarah;
use common\models\SiswaBiodata;
use yii\helpers\Url;
use kartik\file\FileInput;
?>

<div class="siswa-form">
	<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<div class='box box-widget'>
		<div class='box-header with-border'>
			<h1><?= $this->title;?></h1>
		</div>
		<div class='box-body'>
					<?php if (Yii::$app->session->hasFlash('flashMsg')){ ?>
					    <div class="alert alert-danger">
					        <!-- flash message -->
					         Kelas Penuh
					    </div>
					<?php } ?>
			<div class='row'>
				
				<div class='col-sm-7'>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Nomor Induk
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-5'>
									<?= $form->field($model, 'NIS')->textInput(['maxlength' => true])->label(false) ?>
								</div>
								<div class='col-sm-2 label-div'>
									NISN
								</div>
								<div class='col-sm-5'>
									<?= $form->field($model, 'NISN')->textInput(['maxlength' => true])->label(false) ?>
								</div>
							</div>
							 
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							
						</div>
						<div class='col-sm-9'>
							<div class='alert alert-native-danger hide' id='alert-content'>
								Nomor Induk Sudah Terdaftar
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
							Jenis Kelamin
								</div>
						<div class='col-sm-3'>
									<?= $form->field($data, 'JK')->dropDownList([ 'Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan', ], ['prompt' => '- Pilih -'])->label(false) ?>
								</div>
							</div>
							 
						
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kelas
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($model, 'KodeKelas')->dropDownList(ArrayHelper::map(Kelas::find()->orderBy(['Kelas' => SORT_ASC])->all(), 'Kode', 'Kelas'),[
									'prompt'=>'- Pilih Kelas -'])->label(false)?>
						</div>
					</div>
					
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
							Alamat
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($data, 'Alamat')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-6'>
									<?= $form->field($data,'IdProv')->dropDownList(ArrayHelper::map(Provinsi::find()->orderBy('Provinsi')->all(),'Id','Provinsi'),[
										'prompt'=>'- Pilih Provinsi -',
										'onchange'=>'
												$.get("'.Url::toRoute('kabupaten/find-by-prov').'",{ id: $(this).val() }).done(function( data ) 
												{
													  $("select#siswabiodata-idkab" ).html( data );
													});
												
											'
										])->label(false);?>
								</div>
								<div class='col-sm-6'>
									<?= $form->field($data, 'IdKab')->dropDownList(ArrayHelper::map(Kabupaten::find()->all(), 'Id', 'Kabupaten'),[
									'prompt'=>'- Pilih Kabupaten -'])->label(false)?>
								</div>
								</div>
						</div>
					</div>
							<div class='row'>
						<div class='col-sm-3 label-div'>
							Kode Pos
								</div>
						<div class='col-sm-3'>
									<?= $form->field($data, 'Pos')->textInput(['maxlength' => true, 'placeholder' => "Kode Pos"])->label(false) ?>
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
					
					<h4>Alamat Tinggal/Domisili</h4>
					<hr/>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Tinggal Saat Ini
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($data, 'IdDom')->dropDownList(ArrayHelper::map(Domisili::find()->all(), 'Id', 'Status'),[
									'prompt'=>'- Pilih -'])->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Alamat
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($data, 'AlamatDom')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-6'>
									<?= $form->field($data,'IdProvDom')->dropDownList(ArrayHelper::map(Provinsi::find()->orderBy('Provinsi')->all(),'Id','Provinsi'),[
										'prompt'=>'- Pilih Provinsi -',
										'onchange'=>'
												$.get("'.Url::toRoute('kabupaten/find-by-prov').'",{ id: $(this).val() }).done(function( data ) 
												{
													  $("select#siswabiodata-idkabdom" ).html( data );
													});
												
											'
										])->label(false);?>
								</div>
								<div class='col-sm-6'>
									<?= $form->field($data, 'IdKabDom')->dropDownList(ArrayHelper::map(Kabupaten::find()->all(), 'Id', 'Kabupaten'),[
									'prompt'=>'- Pilih Kabupaten -'])->label(false)?>
								</div>
								<div class='col-sm-2'>
									
								</div>
							</div>
						</div>
					
					</div>
				<div class='row'>
						<div class='col-sm-3 label-div'>
							Kode Pos
								</div>
						<div class='col-sm-3'>
									<?= $form->field($data, 'Pos')->textInput(['maxlength' => true, 'placeholder' => "Kode Pos"])->label(false) ?>
								</div>
							</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Telepon
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($data, 'TeleponDom')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
			</div>
				
			<div class='col-sm-5'>
				
				<div class='row'>
					<div class='col-sm-3 label-div'>
						Agama
					</div>
					<div class='col-sm-9'>
						 <?= $form->field($data, 'IdAgm')->dropDownList(ArrayHelper::map(Agama::find()->all(), 'Id', 'Agama'),['prompt'=>'- Pilih -'])->label(false)?>
					</div>
				</div>
				
				<div class='row'>
						<div class='col-sm-3 label-div'>
							Golongan Darah
								</div>
						<div class='col-sm-5'>
									 <?= $form->field($model, 'idGoldar')->dropDownList(ArrayHelper::map(GolonganDarah::find()->all(), 'id', 'GolDar'),['prompt'=>'- Pilih -'])->label(false)?>
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
		<div class='box-footer'>
			<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
		</div>
	</div>

   
    <?php ActiveForm::end(); ?>

</div>

<?php

$urlInc = Url::to(['/siswa/checknis']);
$script = <<< JS
	
	function checkNIS(nis){
		$.ajax({
			type: 'POST',
			url: '{$urlInc}',
			data: {nis:nis},
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
	
	$('#siswa-nis').keyup(function(){
		checkNIS($('#siswa-nis').val());
		});
	
JS;
$this->registerJs($script);
?>