<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use common\models\SiswaBiodata;
use common\models\Pelanggaran;
use common\models\PegawaiBiodata;
use yii\helpers\Url;

$this->title = 'Input Pelanggaran';
$this->params['breadcrumbs'][] = ['label' => 'Pelanggaran', 'url' => ['/guru/pelanggaran']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='member-index'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuGuru');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'>
					<?= $this->title;?>
				</h1>
				<?php $form = ActiveForm::begin(); ?>
				<div class='row rowlist'>
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
				
				<div class='row rowlist'>
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
				
				<div class='row rowlist'>
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
					
					
				
				<?= $form->field($model, 'IdPeg')->hiddenInput(['value' => Yii::$app->user->identity->member->pegawai->IdPeg])->label(false)?>
									
				
				
				<div class='row rowlist'>
					<div class='col-sm-3 label-div'>
						Keterangan
					</div>
					<div class='col-sm-9'>
						<?= $form->field($model, 'Keterangan')->textArea(['rows' => 2])->label(false) ?>
					</div>
				</div>
				<hr/>
				<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
				<?php ActiveForm::end(); ?>

				
			</div>
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