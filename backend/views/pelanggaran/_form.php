<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\PelanggaranKategori;
?>

<div class="pelanggaran-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class='row'>
		<div class='col-sm-6'>
			<div class='box box-widget'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Pelanggaran
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Pelanggaran')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Kategori
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'IdKat')->dropDownList(ArrayHelper::map(PelanggaranKategori::find()->all(), 'Id', 'Kategori'),['prompt'=>'- Pilih Kategori -'])->label(false)?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Point Punishment
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Point')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3 label-div'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					

				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
