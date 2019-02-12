<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;


$this->title = $model->biodata->Nama;
$this->params['breadcrumbs'][] = ['label' => 'Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-view">

    <div class='box box-primary'>
		<div class='box-header with-border'>
			<h1><?= Html::encode($this->title) ?></h1>
		</div>
		<div class='box-body'>
			
			<div class='row'>
				<div class='col-sm-3'>
					<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$model->biodata->Foto,['class' => 'img-responsive img-thumbnail']);?>
				</div>
				<div class='col-sm-9'>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Nomor Induk Siswa
						</div>
						<div class='col-sm-9'>
							<?= $model->NIS;?>
						</div>
					</div>
								
					<div class='row rowlist'>
						<div class='col-sm-3'>
							NISN
						</div>
						<div class='col-sm-9'>
							<?= $model->NISN;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kelas
						</div>
						<div class='col-sm-9'>
							<?= $model->kelas->Kelas;?>
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
							<?= $model->biodata->golonganDarah->GolDar; ?>
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
					
					<h4>Domisili Saat Ini</h4>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Tinggal Dengan
						</div>
						<div class='col-sm-9'>
							<?= $model->biodata->domisili->Status;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Alamat Tinggal
						</div>
						<div class='col-sm-9'>
							<?= $model->biodata->AlamatDom;?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Telepon
						</div>
						<div class='col-sm-9'>
							<?= $model->biodata->TeleponDom;?>
						</div>
					</div>
					
					<h4>Administrasi</h4>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Point
						</div>
						<div class='col-sm-9'>
							<?= $model->Point;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Tagihan
						</div>
						<div class='col-sm-9'>
							<?= Yii::$app->formatter->asDecimal($model->Billing);?>
						</div>
					</div>
					
				</div>
			</div>
			
			<div class='row'>
				<div class='col-sm-12'>
					<?= Yii::$app->algo->renderSplit(30);?>
					<?= Tabs::widget([
							'items' => [
								[
									'label' => 'Wali',
									'content' => $this->render('_wali',['model' => $model]),
									'active' => true
								],
								[
									'label' => 'Nilai Ulangan',
									'content' => $this->render('_nilai',['model' => $model]),
								],
								[
									'label' => 'Nilai Raport',
									'content' => $this->render('_raport',['model' => $model]),
								],
								[
									'label' => 'Agenda',
									'content' => $this->render('_jadwal',['model' => $model]),
								],
								[
									'label' => 'Galery',
									'content' => $this->render('_galery',['galeri' => $galeri]),
								],
							],
						]
						);
					?>
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

    

</div>
