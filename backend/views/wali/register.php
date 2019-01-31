<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = $model->Nama;
$this->params['breadcrumbs'][] = ['label' => 'Wali', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wali-view">
	<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	
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
						<div class='col-sm-3'>
							Nama
						</div>
						<div class='col-sm-9'>
							<?= strtoupper($model->Nama);?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Alamat
						</div>
						<div class='col-sm-9'>
							<?= $model->Alamat.' '.$model->Kota.' '.$model->kabupaten->Kabupaten;?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Provinsi
						</div>
						<div class='col-sm-9'>
							<?= $model->provinsi->Provinsi;?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Telepon
						</div>
						<div class='col-sm-9'>
							<?= $model->Telepon;?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Pekerjaan
						</div>
						<div class='col-sm-9'>
							<?= $model->pekerjaan->Pekerjaan;?>
						</div>
					</div>
					<hr/>
					<h4>Hak Ases</h4>
					
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
				</div>
				<div class='box-footer'>
					<?= Html::submitButton('Daftarkan', ['class' => 'btn btn-success']) ?>
				</div>
			</div>
		</div>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
