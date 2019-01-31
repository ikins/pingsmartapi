<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\JadwalSearch;
$searchModel = new JadwalSearch(['IdGuru' => $model->IdPeg]);
$dataProvider = $searchModel->searchbyGuru(Yii::$app->request->queryParams);
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
			'label' => 'HARI',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'group' => true,
			'groupedRow'=>true,                    
			'groupOddCssClass'=>'kv-grouped-row',  
			'groupEvenCssClass'=>'kv-grouped-row', 
			'value' => function ($model, $key, $index) {
				return($model->hari->Hari);
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