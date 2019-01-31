<?php
use yii\grid\GridView;
use yii\helpers\Html;
use common\models\SiswaWaliSearch;

$searchModel = new SiswaWaliSearch(['NIS' => $model->NIS]);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<?= GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		//'Id',
		[
			'label' => 'Nama',
			'attribute' => '',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return Html::a($model->wali->Nama,['/wali/','id' => $model->wali->Id]);
			},
		],
		[
			'label' => 'Status',
			'attribute' => '',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return $model->status->Status;
			},
		],
		[
			'label' => 'Telepon',
			'attribute' => '',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return $model->wali->Telepon;
			},
		],
		[
			'label' => 'HP',
			'attribute' => '',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return $model->wali->HP;
			},
		],
		[
			'label' => 'Pekerjaan',
			'attribute' => '',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return $model->wali->pekerjaan->Pekerjaan;
			},
		],
	],
]); ?>