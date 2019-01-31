<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\JadwalSearch;

$searchModel = new JadwalSearch(['KodeKelas' => $kodekelas]);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'hover' => true,
	'bordered' => false,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

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
			'label' => 'JENIS',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return($model->jenis->Jenis);
			}, 
		],
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
			'label' => 'Pelajaran',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return($model->pelajaran->Pelajaran);
			}, 
		],
		[
			'label' => 'Pengajar',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				if($model->IdGuru !==' '){
					return($model->IdGuru);
				}
				else{
					return '-';
				}
				
			}, 
		],
		
		
	],
]); ?>