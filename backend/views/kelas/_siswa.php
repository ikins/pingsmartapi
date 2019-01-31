<?php
use yii\helpers\Html;
use kartik\grid\GridView;
?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'hover' => true,
	'bordered' => false,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		[
			'label' => 'NIS',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return Html::a($model->NIS,['/siswa/view','id' => $model->Id]);
			},
		],
		[
			'label' => 'Nama',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return Html::a($model->biodata->Nama,['/siswa/view','id' => $model->Id]);
			},
		],
		[
			'label' => 'Kelas',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return $model->kelas->Kelas;
			},
		],
		[
			'label' => 'Tempat,Tgl Lahir',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return $model->biodata->KotaLahir.', '.Yii::$app->algo->tglIndoNoTime($model->biodata->TglLahir);
			},
		],
		
		[
			'label' => 'Alamat',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return $model->biodata->AlamatDom;
			},
		],
		[
			'label' => 'Point',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) { 
				return $model->Point;
			},
		],
		
		
	],
]); ?>