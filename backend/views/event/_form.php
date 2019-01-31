<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use marqu3s\summernote\Summernote;
use kartik\widgets\TimePicker;

use common\models\EventJenis;
use common\models\EventStatus;

?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<div class='row'>
		
		<div class='col-sm-4'>
			
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1>Waktu Penyelenggaraan</h1>
				</div>
				<div class='box-body'>
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Tanggal
						</div>
						<div class='col-sm-9'>
						
							<div class='row'>
								<div class='col-sm-8'>
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
								<div class='col-sm-4'>
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
							</div>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Tanggal Selesai
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-8'>
									<?=	$form->field($model, 'TanggalAkhir')->widget(DateControl::classname(), [
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
								<div class='col-sm-4'>
									<?= $form->field($model, 'JamSelesai')->widget(TimePicker::classname(), [
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
						<div class='col-sm-3 label-div'>
							Jenis Event
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdJenis')->dropDownList(ArrayHelper::map(EventJenis::find()->all(),'Id', 'Jenis'),array('prompt'=>'Pilih Jenis'))->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Tempat
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Tempat')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Status
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdStat')->dropDownList(ArrayHelper::map(EventStatus::find()->all(),'Id', 'Status'),array('prompt'=>'Pilih Status'))->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Keterangan')->textArea(['rows' => 3])->label(false) ?>
						</div>
					</div>
				
				</div>
			</div>
			
		</div>
		<div class='col-sm-8'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1>Deskripsi Kegiatan</h1>
				</div>
				<div class='box-body'>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Nama Kegiatan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Event')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Deskripsi
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Deskripsi')->widget(Summernote::className(), [
								'clientOptions' => ['placeHolder' => 'Wow']
							])->label(false) ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class='col-sm-12'>
			<div class='box box-default'>
				<div class='box-body'>
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
			
		</div>
	</div>
  
    
    <?php ActiveForm::end(); ?>

</div>
