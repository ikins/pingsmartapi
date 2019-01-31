<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = 'Detail';
$this->params['breadcrumbs'][] = ['label' => 'Siswa Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-record-view">
	<div class='row'>
		<div class='col-sm-5'>	
			<div class='box box-widget'>
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
							<?= $model->siswa->biodata->Nama;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kelas
						</div>
						<div class='col-sm-9'>
							<?= $model->siswa->kelas->Kelas;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Tanggal Pelanggaran
						</div>
						<div class='col-sm-9'>
							<?= Yii::$app->formatter->asDate($model->Tanggal);?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Pelanggaran
						</div>
						<div class='col-sm-9'>
							<?= $model->pelanggaran->Pelanggaran;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kategori
						</div>
						<div class='col-sm-9'>
							<?= $model->pelanggaran->kategori->Kategori;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Demote Poin
						</div>
						<div class='col-sm-9'>
							<?= $model->Point;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Dilaporkan Oleh
						</div>
						<div class='col-sm-9'>
							<?= $model->pegawai->biodata->Nama;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $model->Keterangan;?>
						</div>
					</div>
					
				</div>
				<div class='box-footer'>
					<?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
					<?= Html::a('Delete', ['delete', 'id' => $model->Id], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => 'Are you sure you want to delete this item?',
							'method' => 'post',
						],
					]) ?>
				</div>
			</div>
		</div>
	</div>

</div>
