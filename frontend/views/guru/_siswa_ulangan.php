<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\NilaiDetailSearch;

$searchModel = new NilaiDetailSearch(['NIS' => $model->NIS]);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);


?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'bordered' => false,
	'columns' => [
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
			'label' => 'Nilai',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return $model->Nilai;
			}, 
		],
		[
			'label' => 'Pengajar',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return $model->parent->guru->biodata->Nama;
			}, 
		],
		
		[
			'label' => 'Status',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return $model->status->Status;
			}, 
		],
		[
			'label' => 'Jenis Nilai',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return $model->parent->jenis->Jenis;
			}, 
		],

		
	],
]); ?>