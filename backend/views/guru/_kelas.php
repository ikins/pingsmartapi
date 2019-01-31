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
	['class' => 'kartik\grid\SerialColumn'],

	[
		'label' => 'Kelas',
		'attribute' => '',
		'format' => 'raw',
		'vAlign' => 'middle',
		'value' => function ($model, $key, $index) { 
			return Html::a($model->kelas->Kelas,['/kelas/view','id' => $model->Id]);
		},
	],
	[
		'label' => 'Kelas',
		'attribute' => '',
		'format' => 'raw',
		'vAlign' => 'middle',
		'value' => function ($model, $key, $index) { 
			return Html::a($model->kelas->jurusan->Jurusan,['/kelas/view','id' => $model->Id]);
		},
	],
	
	[
		'label' => 'Kompetensi',
		'attribute' => '',
		'format' => 'raw',
		'vAlign' => 'middle',
		'value' => function ($model, $key, $index) { 
			if($model->kelas->IdKom > 0){return $model->kelas->kompetensi->Kompetensi;}else{return '';}
			
		},
	],
	[
		'label' => 'Jumlah Siswa',
		'attribute' => '',
		'format' => 'raw',
		'vAlign' => 'middle',
		'value' => function ($model, $key, $index) { 
			return $model->kelas->Jumlah;
			
		},
	],
	
],
]); ?>