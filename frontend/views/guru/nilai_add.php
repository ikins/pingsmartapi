<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use common\models\PegawaiBiodata;
use common\models\GuruAjar;
use common\models\NilaiJenis;
use common\models\Pelajaran;
use yii\helpers\Url;

$this->title = 'Input Nilai';
$this->params['breadcrumbs'][] = ['label' => 'Nilai', 'url' => ['/guru/nilai']];
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
						Kelas
					</div>
					<div class='col-sm-9'>
						<?= $form->field($model, 'KodeKelas')->dropDownList(ArrayHelper::map(GuruAjar::find()->select('KodeKelas')->where(['IdPeg' => Yii::$app->user->identity->member->pegawai->IdPeg])->distinct()->all(), 'KodeKelas', 'kelas.Kelas'),['prompt'=>'- Pilih Kelas -'])->label(false)?>
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
						<?= $form->field($model, 'KodePel')->dropDownList(ArrayHelper::map(GuruAjar::find()->select('KodePel')->where(['IdPeg' => Yii::$app->user->identity->member->pegawai->IdPeg])->distinct()->all(), 'KodePel', 'pelajaran.Pelajaran'),['prompt'=>'- Pilih Pelajaran -'])->label(false)?>
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
				<?= Html::submitButton($model->isNewRecord ? 'Selanjutnya' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
				<?php ActiveForm::end(); ?>

				
			</div>
		</div>
	</div>
</div>

