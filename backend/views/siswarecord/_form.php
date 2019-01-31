<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use common\models\SiswaBiodata;
use common\models\Pelanggaran;
use common\models\PegawaiBiodata;
use yii\helpers\Url;
?>

<div class="siswa-record-form">
	
	<div class='row'>
		<div class='col-sm-6 col-md-4'>
			<?php $form = ActiveForm::begin(); ?>
		
			<div class='box box-widget'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Tanggal
						</div>
						<div class='col-sm-9'>
							<?=	$form->field($model, 'Tanggal')->widget(DateControl::classname(), [
								'type'=>DateControl::FORMAT_DATE,
								'options' => [
									'options' => ['placeholder' => 'Pilih Tanggal Mulai ...'],
									'removeButton' => false,
									'pluginOptions' => [
										'autoclose' => true,
										'todayHighlight' => true,
									]
								]
								])->label(false);?>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Siswa
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'NIS')->dropDownList(ArrayHelper::map(SiswaBiodata::find()->orderBy('Nama')->all(),'NIS', 'Nama'),array('prompt'=>'Pilih Siswa'))->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-7'>
									<div class='row'>
										<div class='col-sm-4 label-div'>Kelas</div>
										<div class='col-sm-8 form-group'>
											<div class='form-control' id='kelas'></div>
										</div>
									</div>
								</div>
								<div class='col-sm-5'>
									<div class='row'>
										<div class='col-sm-8 form-group'>
											<div class='form-control' id='point'></div>
										</div>
										<div class='col-sm-4 label-div'>Point</div>
									</div>
								</div>
							</div>
							<hr/>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Pelanggaran
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdPel')->dropDownList(ArrayHelper::map(Pelanggaran::find()->orderBy('Pelanggaran')->all(),'Id', 'Pelanggaran'),array('prompt'=>'-Pilih Pelanggaran-'))->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Poin
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Point')->textInput(['readonly' => true])->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Dilaporkan Oleh
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdPeg')->dropDownList(ArrayHelper::map(PegawaiBiodata::find()->orderBy('Nama')->all(),'IdPeg', 'Nama'),array('prompt'=>'Pelapor'))->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Keterangan')->textArea()->label(false)?>
						</div>
					</div>
						
					
					
				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Catat' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>

</div>


<?php

$urlPoint = Url::to(['/pelanggaran/getpoint']);
$urlSiswa = Url::to(['/siswa/getdata']);
$script = <<< JS
	
	function checkPoint(idpel){
		$.ajax({
			type: 'POST',
			url: '{$urlPoint}',
			data: {idpel:idpel},
			dataType: 'json',
			success: function (data) {
				
				$('#siswarecord-point').val(data);
			}
			
		});
	}
	
	$('#siswarecord-idpel').change(function(){
		checkPoint($(this).val());
	});
	
	function checkSiswa(nis){
		$.ajax({
			type: 'POST',
			url: '{$urlSiswa}',
			data: {nis:nis},
			dataType: 'json',
			success: function (data) {
				var res = JSON.parse(JSON.stringify(data));
				$('#point').html(res[0].Point);
				$('#kelas').html(res[0].Kelas);
			}
			
		});
	}
	
	$('#siswarecord-nis').change(function(){
		checkSiswa($(this).val());
	});
	
JS;
$this->registerJs($script);
?>