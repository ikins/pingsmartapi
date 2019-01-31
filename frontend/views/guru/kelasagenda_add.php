<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

use common\models\MemberLevel;
use common\models\PengumumanStatus;
use common\models\SiswaBiodata;
use yii\helpers\Url;

$this->title = 'Buat Agenda Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Agenda', 'url' => ['/guru/pengumuman']];
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
						Judul
					</div>
					<div class='col-sm-9'>
						<?= $form->field($model, 'Judul')->textInput(['maxlength' => true])->label(false) ?>
					</div>
				</div>
				
				<div class='row rowlist'>
					<div class='col-sm-3 label-div'>
						Deskripsi
					</div>
					<div class='col-sm-9'>
						<?= $form->field($model, 'Deskripsi')->widget(CKEditor::className(), [
						'options' => ['rows' => 5],
						'preset' => 'basic'
					])->label(false) ?>
					</div>
				</div>
				
				
				<div class='row rowlist'>
					<div class='col-sm-3 label-div'>
						Target Kelas
					</div>
					<div class='col-sm-9'>
						<?=	$form->field($model, 'KodeKelas[]')->widget(Select2::className(),
							[
								'data'=> common\models\Kelas::getOptions(),
								'size' => Select2::SMALL,
								'options' => [
									'tags' => true,
									'multiple' => true
								],
							]
							)->label(false);
						?>
					</div>
				</div>
				
				<div class='row rowlist'>
					<div class='col-sm-3 label-div'>
						Target Siswa
					</div>
					<div class='col-sm-9'>
						<?=	$form->field($model, 'NIS[]')->widget(Select2::className(),
							[
								'data'=> common\models\SiswaBiodata::getOptions(),
								'size' => Select2::SMALL,
								'options' => [
									'tags' => true,
									'multiple' => true
								],
							]
							)->label(false);
						?>
					</div>
				</div>
				
				
				
				<div class='row rowlist'>
					<div class='col-sm-3 label-div'>
						Tanggal Kegiatan
					</div>
					<div class='col-sm-9'>
						<div class='row'>
							<div class='col-sm-6'>
								<?= $form->field($model, 'TglAwal')->widget(DateControl::classname(), [
									'type'=>DateControl::FORMAT_DATE,
									'options' => [
										'options' => ['placeholder' => 'Tanggal Awal'],
										'removeButton' => false,
										'pluginOptions' => [
											'autoclose' => true,
											'todayHighlight' => true,
										]
									]
									])->label(false);?>
							</div>
							<div class='col-sm-3 label-div'>	
								Jam Mulai
							</div>
							<div class='col-sm-3'>
								<?= $form->field($model, 'JamAwal',['inputOptions' =>['placeholder' => '07:00','class' => 'form-control']])->textInput(['maxlength' => true])->label(false) ?>
							</div>
						</div>
					</div>
				</div>
				
				<div class='row rowlist'>
					<div class='col-sm-3 label-div'>
						s.d.
					</div>
					<div class='col-sm-9'>
						<div class='row'>
							<div class='col-sm-6'>
								<?= $form->field($model, 'TglAkhir')->widget(DateControl::classname(), [
									'type'=>DateControl::FORMAT_DATE,
									'options' => [
										'options' => ['placeholder' => 'Tanggal Awal'],
										'removeButton' => false,
										'pluginOptions' => [
											'autoclose' => true,
											'todayHighlight' => true,
										]
									]
									])->label(false);?>
							</div>
							<div class='col-sm-3 label '>	
								Jam Akhir
							</div>
							<div class='col-sm-3'>
								<?= $form->field($model, 'JamAkhir',['inputOptions' =>['placeholder' => '07:00','class' => 'form-control']])->textInput(['maxlength' => true])->label(false) ?>
							</div>
						</div>
					</div>
				</div>
				
				<div class='row rowlist'>
					<div class='col-sm-3 label-div'>
						Keterangan
					</div>
					<div class='col-sm-9'>
						<?= $form->field($model, 'Keterangan')->textArea(['rows' => 3])->label(false) ?>
					</div>
				</div>
				
				<?= Html::submitButton($model->isNewRecord ? 'Proses' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
				<?php ActiveForm::end(); ?>

				
			</div>
		</div>
	</div>
</div>

