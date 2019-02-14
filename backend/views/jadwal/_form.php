<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Kelas;
use common\models\JadwalJenis;
use common\models\Hari;
use common\models\Pelajaran;
use common\models\Pegawai;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\widgets\TimePicker;
?>

<div class="jadwal-form">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<div class='row'>
		<div class='col-lg-6'>
			<div class='box box-widget'>
				<div class='box-header with-border'>
					<h1><?= $this->title;?></h1>
				</div>
				<div class='box-body'>
				   
						<div class='row'>
							<div class="col-sm-3 label-div">
								Kelas
							</div>
							<div class='col-sm-9'>
								 <?= $form->field($model, 'KodeKelas')->dropDownList(ArrayHelper::map(Kelas::find()->orderBy(['Kelas' => SORT_ASC])->all(), 'Kode', 'Kelas'),[
										'prompt'=>'- Pilih Kelas -'])->label(false)?>
							</div>
						</div>
						
						<div class='row'>
							<div class="col-sm-3 label-div">
								Hari
							</div>
							<div class='col-sm-9'>
								 <?= $form->field($model, 'IdHari')->dropDownList(ArrayHelper::map(Hari::find()->orderBy(['Id' => SORT_ASC])->all(), 'Id', 'Hari'),[
										'prompt'=>'- Pilih Hari -'])->label(false)?>
							</div>
						</div>
						
						<div class='row'>
							<div class="col-sm-3 label-div">
								Jam Mulai
							</div>
							<div class='col-sm-9'>
								<div class='row'>
									<div class='col-sm-5'>
										 <?= $form->field($model, 'JamMulai')->widget(TimePicker::classname(), [
												'pluginOptions' => [
													'showSeconds' => false,
													'showMeridian' => false,
													'minuteStep' => 1,
													'secondStep' => 5,
												]
											])->label(false);
										  ?>
									</div>
									<div class='col-sm-2 label-div'>
										Jam Akhir
									</div>
									<div class='col-sm-5'>
										<?= $form->field($model, 'JamAkhir')->widget(TimePicker::classname(), [
												'pluginOptions' => [
													'showSeconds' => false,
													'showMeridian' => false,
													'minuteStep' => 1,
													'secondStep' => 5,
												]
											])->label(false);
										  ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class='row'>
							<div class="col-sm-3 label-div">
								Jenis
							</div>
							<div class='col-sm-9'>
								 <?= $form->field($model, 'IdJenis')->dropDownList(ArrayHelper::map(JadwalJenis::find()->all(), 'Id', 'Jenis'),[
										'prompt'=>'- Pilih Jenis -'])->label(false)?>
							</div>
						</div>

						<div class='row'>
							<div class="col-sm-3 label-div">
								Kode Pelajaran
							</div>
							<div class='col-sm-9'>
								 <?= $form->field($model, 'KodePel')->dropDownList(ArrayHelper::map(Pelajaran::find()->orderBy(['Pelajaran' => SORT_ASC])->all(), 'Kode', 'Pelajaran'),[
										'prompt'=>'- Pilih Pelajaran -'])->label(false)?>
							</div>
						</div>

						

						

						

						<div class='row'>
							<div class="col-sm-3 label-div">
								Pengajar
							</div>
							<div class='col-sm-9'>
								 <?= $form->field($model, 'IdGuru')->dropDownList(ArrayHelper::map(Pegawai::find()->joinWith('biodata')->where(['IdJab' => 3])->orderBy(['pegawai_biodata.Nama' => SORT_ASC])->all(), 'IdPeg', 'biodata.Nama'),[
										'prompt'=>'- Pilih Guru -'])->label(false)?>
							</div>
						</div>

						<div class='row'>
							<div class="col-sm-3 label-div">
								Keterangan
							</div>
							<div class='col-sm-9'>
								 <?= $form->field($model, 'Keterangan')->textArea(['maxlength' => true])->label(false) ?>
							</div>
						</div>
					</div>
					<div class='box-footer'>
						<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
		
		<div class='col-lg-6' id='_list'>
			
		</div>
	</div>
    
</div>