<?php 
use yii\helpers\Html;
use common\models\Jadwal;
use common\models\JadwalSearch;
use kartik\grid\GridView;
$jd=new Jadwal;
date_default_timezone_set("Asia/Jakarta");
?>
<div class='guru-dashboard'>
	
	<div class='row'>
		<div class='col-sm-2'>
			<div class='box'>
				<h1 class='stat-heading'><?= $jd->getTeachingHour(Yii::$app->user->identity->member->pegawai->IdPeg);?></h1>
				<div class='stat-description'>Jam Mengajar</div>
			</div>
		</div>
		
		<div class='col-sm-5'>
			<div class='box'>
				<h1 class='stat-heading'><?= $jd->getNowSchedule(Yii::$app->user->identity->member->pegawai->IdPeg, date('H:i:s')); ?></h1>
				<div class='stat-description'>Kelas Saat Ini</div>
			</div>
		</div>
		
		<div class='col-sm-5'>
			<div class='box'>
				<h1 class='stat-heading'><?= $jd->getNextSchedule(Yii::$app->user->identity->member->pegawai->IdPeg, date('H:i:s'));?></h1>
				<div class='stat-description'>Kelas Berikutnya</div>
			</div>
		</div>
	</div>
	<div class='row'>
		<div class='col-sm-12'>
			<h5 class='module-header'>Jadwal Mengajar Hari ini<span class='pull-right'><?= Yii::$app->algo->showToday();?></h5>
			<?php
			$searchModel = new JadwalSearch(['IdGuru' => Yii::$app->user->identity->member->pegawai->IdPeg, 'IdHari' => date('N') + 1]);
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
						
			?>
			
			<?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'hover' => true,
                'bordered' => false,
                'columns' => [
                    
					[
                        'label' => 'Jam',
                        'attribute' => '',
                        'format' => 'raw',
                        'vAlign' => 'middle',
                        'value' => function ($model, $key, $index) {
                            return(substr($model->JamMulai,0,5).' - '.substr($model->JamAkhir,0,5));
                        }, 
                    ],
                    [
                        'label' => 'KELAS',
                        'attribute' => '',
                        'format' => 'raw',
                        'vAlign' => 'middle',
						'value' => function ($model, $key, $index) {
                            return Html::a('Kelas '.$model->KodeKelas, ['/guru/siswa', 'id' => $model->kelas->Id]);
                        }, 
                    ],
					
                    [
                        'label' => 'Pelajaran',
                        'attribute' => '',
                        'format' => 'raw',
                        'vAlign' => 'middle',
                        'value' => function ($model, $key, $index) {
                            return($model->pelajaran->Pelajaran);
                        }, 
                    ],
                
                ],
            ]); ?>
		</div>
		
		<div class='col-sm-12'>
			<h5 class='module-header'>Pengumuman</h5><hr/>
		</div>
		
	</div>
	
</div>