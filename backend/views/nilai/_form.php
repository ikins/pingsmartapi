<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use common\models\PegawaiBiodata;
use common\models\Kelas;
use common\models\NilaiJenis;
use common\models\Pelajaran;
use yii\helpers\Url;
?>

<div class="nilai-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class='row'>
		<div class='col-md-6'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Kelas
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'KodeKelas')->dropDownList(ArrayHelper::map(Kelas::find()->orderBy(['Kelas' => SORT_ASC])->all(), 'Kode', 'Kelas'),['prompt'=>'- Pilih Kelas -'])->label(false)?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Jenis Nilai
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdJenis')->dropDownList(ArrayHelper::map(NilaiJenis::find()->all(), 'Id', 'Jenis'),['prompt'=>'- Pilih Jenis -'])->label(false)?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Mata Pelajaran
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'KodePel')->dropDownList(ArrayHelper::map(Pelajaran::find()->orderBy(['Pelajaran' => SORT_ASC])->all(), 'Kode', 'Pelajaran'),['prompt'=>'- Pilih Pelajaran -'])->label(false)?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Tanggal Tes
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Tanggal')->widget(DateControl::classname(), [
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
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Nama Guru
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdPeg')->dropDownList(ArrayHelper::map(PegawaiBiodata::find()->orderBy(['Nama' => SORT_ASC])->all(), 'IdPeg', 'Nama'),['prompt'=>'- Pilih Guru -'])->label(false)?>
						</div>
					</div>
					
					
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Keterangan')->textArea(['rows' => 2])->label(false) ?>
						</div>
					</div>
										
				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Next' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
			
		</div>
	</div>
	
    <?php ActiveForm::end(); ?>

</div>
