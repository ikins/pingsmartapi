<?php
use yii\helpers\Html;
?>

<div class='row'>
	<div class='col-sm-4'>
		<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$model->biodata->Foto,['class' => 'img-responsive img-thumbnail']);?>
	</div>				
	<div class='col-sm-8'>
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
		<hr/>
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
		<hr/>
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
		<hr/>
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