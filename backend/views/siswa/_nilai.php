<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\NilaiDetailSearch;
use common\models\Nilai;
use common\models\NilaiJenis;

$searchModel = new NilaiDetailSearch(['NIS' => $model->NIS]);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);








?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'bordered' => false,
	'columns' => [
		[
			'label' => 'Nama Pengajar',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return $model->parent->guru->biodata->Nama;
			}, 
		],
	
		[
			'label' => 'Mata Pelajaran',
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
		[
						'label' => 'Action',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							
							return '<div class="btn-group">
								  <button type="button" class="btn btn-default dropdown-toggle btn-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="fa fa-bars"></span>
								  </button>
								  <ul class="dropdown-menu">
									<li>'.Html::a('Hapus',['delete','id' => $model->Id],[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
												'data-method' => 'post',
												]).'</li>
								  </ul>
								</div>';
							
						},
						
					],

		
	],
]); ?>