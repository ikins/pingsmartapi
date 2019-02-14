<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\KelasGrade;
use common\models\Jurusan;
use common\models\Kompetensi;
use common\models\Member;
use common\models\KelasLevel;
?>

<div class="kelas-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class='row'>
		<div class='col-sm-6'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1><?= $this->title;?></h1>
				</div>
				<div class='box-body'>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Jenis Kelas
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-5'>
									<?= $form->field($model, 'IdGrade')->dropDownList(ArrayHelper::map(KelasGrade::find()->all(), 'Id', 'Grade'))->label(false)?>
								</div>
								<div class='col-sm-3 label-div'>
									Tingkat
								</div>
								<div class='col-sm-4'>
									<?= $form->field($model, 'IdLev')->dropDownList(ArrayHelper::map(KelasLevel::find()->all(), 'Id', 'Level'))->label(false)?>
								</div>
							</div>
							
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Jurusan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdJur')->dropDownList(ArrayHelper::map(Jurusan::find()->all(), 'Id', 'Jurusan'))->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kompetensi
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdKom')->dropDownList(ArrayHelper::map(Kompetensi::find()->all(), 'Id', 'Kompetensi'),['prompt'=>'- Non Kompetensi -'])->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kode Kelas
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-3'>
									<?= $form->field($model, 'Kode')->textInput(['maxlength' => true])->label(false) ?>
								</div>
								<div class='col-sm-3 label-div'>
									Nama Kelas
								</div>
								<div class='col-sm-3'>
									<?= $form->field($model, 'Kelas')->textInput(['maxlength' => true])->label(false) ?>
								</div>
							</div>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-3 label-div'>
							Jumlah Siswa
						</div>
						<div class='col-sm-9'>
							<div class='row'>
								<div class='col-sm-3'>
									<?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true])->label(false) ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Wali Kelas
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdWk')->dropDownList(ArrayHelper::map(Member::find()->orderBy(['IdLev' => 4 ])->all(), 'MemberId', 'Nama'),['prompt'=>'- Pilih Wali Kelas -'])->label(false)?>
						</div>
					</div>
					

					

				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
		</div>
	</div>
    
	
    <?php ActiveForm::end(); ?>

</div>
