<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

$this->title = $model->biodata->Nama;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">
	
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuGuru');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'>
					<?= $this->title;?>
					<?= Html::a('Kelas '.$model->kelas->Kelas,['/guru/siswa','id' => $model->kelas->Id],['class' => 'btn btn-info pull-right']);?>
				</h1>
				
				<div class='row'>
					<div class='col-sm-12'>
					<?= Yii::$app->algo->renderSplit(20);?>
					<?= Tabs::widget([
							'items' => [
								[
									'label' => 'Biodata',
									'content' => $this->render('_siswa_pim',['model' => $model]),
									'active' => true
								],
								[
									'label' => 'Nilai Ulangan',
									'content' => $this->render('_siswa_ulangan',['model' => $model]),
									
								],
								[
									'label' => 'Nilai Raport',
									'content' => '',
								],
								[
									'label' => 'Jadwal Pelajaran',
									'content' => $this->render('_siswa_jadwal',['model' => $model]),
								],
								[
									'label' => 'Galery',
									'content' => $this->render('_siswa_galeri',['galeri' => $galeri]),
								],
								/*[
									'label' => 'Pelanggaran',
									'content' => $this->render('_siswa_record',['model' => $model]),
								],*/
							],
						]
						);
					?>
				</div>
				</div>
				
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
</div>
