<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

$this->title = 'Profil Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-view">

    <div class='box box-primary'>
		<div class='box-header with-border'>
			<h1><?= $model->biodata->Nama ?></h1>
		</div>
		<div class='box-body'>
			
			<div class='row'>
				<div class='col-sm-3'>
					<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$model->biodata->Foto,['class' => 'img-responsive img-thumbnail']);?>
				</div>
				<div class='col-sm-9'>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							NIP
						</div>
						<div class='col-sm-9'>
							<?= $model->NIP;?>
						</div>
					</div>
								
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kode Pegawai
						</div>
						<div class='col-sm-9'>
							<?= $model->IdPeg;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Jabatan
						</div>
						<div class='col-sm-9'>
							<?= $model->jabatan->Jabatan;?>
						</div>
					</div>
					
					<h4>Biodata</h4>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Nama
						</div>
						<div class='col-sm-9'>
							<?= strtoupper($model->biodata->Nama);?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Tempat, Tanggal Lahir
						</div>
						<div class='col-sm-9'>
							<?= $model->biodata->KotaLahir.', '.Yii::$app->algo->tglIndoNoTime($model->biodata->TglLahir);?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Agama
						</div>
						<div class='col-sm-9'>
							<?= $model->biodata->agama->Agama;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Golongan Darah
						</div>
						<div class='col-sm-9'>
							<?= $model->biodata->idGoldar; ?>
						</div>
					</div>
					<?= Yii::$app->algo->renderSplit(20);?>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Alamat
						</div>
						<div class='col-sm-9'>
							<?= $model->biodata->Alamat;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Telepon
						</div>
						<div class='col-sm-9'>
							<?= $model->biodata->Telepon;?>
						</div>
					</div>
					
					
					
				</div>
			</div>
					
			
		</div>
		<div class='box-footer'>
			<?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-warning']) ?>
			<?= Html::a('Delete', ['delete', 'id' => $model->Id], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Are you sure you want to delete this item?',
					'method' => 'post',
				],
			]) ?>
		</div>
	

    

</div>
