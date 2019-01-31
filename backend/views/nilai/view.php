<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->jenis->Jenis;
$this->params['breadcrumbs'][] = ['label' => 'Nilais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-view">

    <div class='box box-default'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
			</h1>
		</div>
		<div class='box-body'>
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
							<?= $model->jenis->Jenis;?>
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
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Tanggal Tes
						</div>
						<div class='col-sm-9'>
							<?= Yii::$app->formatter->asDate($model->Tanggal);?>
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
							<?= $model->guru->biodata->Nama;?>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-12'>
					<?= $this->render('_detail',['model' => $model]);?>
				</div>
			</div>
		</div>
		<div class='box-footer'>
		</div>
	</div>
	
	
	
	
	
	
</div>
