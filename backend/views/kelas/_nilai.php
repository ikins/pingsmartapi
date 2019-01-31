<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\NilaiSearch;

$searchModel = new NilaiSearch(['KodeKelas' => $kodekelas,'IdJenis' => 1]);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'columns' => [
		['class' => 'kartik\grid\SerialColumn'],

		[
			'label' => 'Tanggal',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return Yii::$app->formatter->asDate($model->Tanggal);
			},
		],
		[
			'label' => 'Pelajaran',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return Html::a($model->pelajaran->Pelajaran,['/nilai/view','id' => $model->Id]);
			},
		],
		
		[
			'label' => 'Guru',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return $model->guru->biodata->Nama;
			},
		],
	],
]); ?>