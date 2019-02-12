<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

$this->title = 'Profil Guru';
$this->params['breadcrumbs'][] = ['label' => 'Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-view">

    <div class='box box-primary'>
		<div class='box-header with-border'>
			<h1><?= Html::encode($model->biodata->Nama) ?></h1>
		</div>
		<div class='box-body'>
			
			<div class='row'>
				<div class='col-sm-3'>
					<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$model->biodata->Foto,['class' => 'img-responsive img-thumbnail']);?>
				</div>
				<div class='col-sm-5'>
					<div class='row rowlist'>
						<div class='col-sm-4'>
							NIP
						</div>
						<div class='col-sm-8'>
							<?= $model->NIP;?>
						</div>
					</div>
								
					<div class='row rowlist'>
						<div class='col-sm-4'>
							Kode Pegawai
						</div>
						<div class='col-sm-8'>
							<?= $model->IdPeg;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-4'>
							Jabatan
						</div>
						<div class='col-sm-8'>
							<?= $model->jabatan->Jabatan;?>
						</div>
					</div>
					
					<h4>Biodata</h4>
					<div class='row rowlist'>
						<div class='col-sm-4'>
							Nama
						</div>
						<div class='col-sm-8'>
							<?= strtoupper($model->biodata->Nama);?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-4'>
							Tempat, Tanggal Lahir
						</div>
						<div class='col-sm-8'>
							<?= $model->biodata->KotaLahir.', '.Yii::$app->algo->tglIndoNoTime($model->biodata->TglLahir);?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-4'>
							Agama
						</div>
						<div class='col-sm-8'>
							<?= $model->biodata->agama->Agama;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-4'>
							Golongan Darah
						</div>
						<div class='col-sm-8'>
							
						</div>
					</div>
					<?= Yii::$app->algo->renderSplit(20);?>
					<div class='row rowlist'>
						<div class='col-sm-4'>
							Alamat
						</div>
						<div class='col-sm-8'>
							<?= $model->biodata->Alamat;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-4'>
							Telepon
						</div>
						<div class='col-sm-8'>
							<?= $model->biodata->Telepon;?>
						</div>
					</div>
					
				</div>
				<div class='col-sm-4 min-grid'>
					<?php if($model->member->IdLev == 4):?>
						<h4 class='noup'>Mata Pelajaran</h4>
						<?= $this->render('_pelajaran',['searchModel'=> $searchModel,'dataProvider' => $dataProvider,'guru'=>$model]);?>
					<?php endif;?>
				</div>
			</div>
			
			<div class='row'>
				<div class='col-sm-12'>
					<?= Yii::$app->algo->renderSplit(30);?>
					<?= Tabs::widget([
							'items' => [
								[
									'label' => 'Kelas',
									'content' => $this->render('_kelas',['dataProvider' => $dataProvider,'searchModel' => $searchModel]),
									'active' => true
								],
								[
									'label' => 'Jadwal Mengajar',
									'content' => $this->render('_jadwal',['model' => $model]),
								],
								[
									'label' => 'Nilai',
									'content' => $this->render('_nilai',['model' => $model]),
									
								],
								
							],
						]
						);
					?>
				</div>
			</div>	
					
			
		</div>
		<div class='box-footer'>
			<?= Html::a('Update', ['/pegawai/update', 'id' => $model->Id], ['class' => 'btn btn-warning']) ?>
		</div>
	</div>

    

</div>
