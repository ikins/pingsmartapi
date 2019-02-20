<?php
use yii\helpers\Html;
$this->title = 'Detail Nilai';
$this->params['breadcrumbs'][] = ['label' => 'Nilai', 'url' => ['/guru/nilai']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='member-index'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuSiswa');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'>
					<?= $this->title;?>
				</h1>
				<div class='row'>
					<div class='col-sm-12'>
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Kode Nilai
							</div>
							<div class='col-sm-9'>
								<?= $model->Kode;?>
							</div>
						</div>
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Jenis
							</div>
							<div class='col-sm-9'>
								<?= $model->parent->jenis->Jenis;?>
							</div>
						</div>
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Kelas
							</div>
							<div class='col-sm-9'>
								<?= $model->parent->kelas->Kelas;?>
							</div>
						</div>
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Tanggal Tes
							</div>
							<div class='col-sm-9'>
								<?= Yii::$app->formatter->asDate($model->parent->Tanggal);?>
							</div>
						</div>
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Pelajaran
							</div>
							<div class='col-sm-9'>
								<?= $model->pelajaran->Pelajaran;?>
							</div>
						</div>
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Guru
							</div>
							<div class='col-sm-9'>
								<?= $model->parent->guru->biodata->Nama;?>
							</div>
						</div>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-sm-12'>
						<?= $this->render('_nilai_detail',['model' => $model]);?>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

