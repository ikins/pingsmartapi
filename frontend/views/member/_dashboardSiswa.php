<?php 
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use common\models\Siswa;
use common\models\Jadwal;
use common\models\JadwalSearch;
use common\models\PengumumanSearch;
use kartik\grid\GridView;
$jd=new Jadwal;
date_default_timezone_set("Asia/Jakarta");
?>
<div class='siswa-dashboard'>
		<div class='row'>
			<div class='col-sm-12'>
			<h5 class='module-header'>Jadwal Pelajaran Hari ini<span class='pull-right'><?= Yii::$app->algo->showToday();?></h5>
			<?php
			$siswa=Siswa::find()->where(['MemberId' => Yii::$app->user->identity->member->MemberId])->one();
			$searchModel = new JadwalSearch(['KodeKelas' => $siswa->KodeKelas, 'IdHari' => date('N') + 1]);
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
				<h5 class='module-header'>Pengumuman</h5>
				<?php
				$siswa=Siswa::find()->where(['MemberId' => Yii::$app->user->identity->member->MemberId])->one();

				$query = PengumumanSearch::find()
				->where(['like', 'Target', '%' . Yii::$app->user->identity->member->IdLev . '%', false])
				->andFilterWhere(['like', 'KodeKelas', '%' . $siswa->KodeKelas . '%', false]);
				$dataProvider = new ActiveDataProvider(['query' => $query,]);	
				?>

				<?= GridView::widget([
	                'dataProvider' => $dataProvider,
	                //'filterModel' => $searchModel,
	                'hover' => true,
	                'bordered' => false,
	                'columns' => [
	                    
						[
	                        'label' => 'Tanggal',
	                        'attribute' => '',
	                        'format' => 'raw',
	                        'vAlign' => 'middle',
	                        'value' => function ($model, $key, $index) {
	                            return(date('d M Y', strtotime($model->Tanggal)));
	                        }, 
	                    ],
						
	                    [
	                        'label' => 'Judul',
	                        'attribute' => '',
	                        'format' => 'raw',
	                        'vAlign' => 'middle',
	                        'value' => function ($model, $key, $index) {
	                            return Html::a($model->Judul, ['/guru/pengumuman-view', 'id' => $model->Id]);
	                        }, 
	                    ],
	                
	                ],
	            ]); ?>
			</div>
		</div>
		
	</div>
	
</div>