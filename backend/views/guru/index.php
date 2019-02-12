<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\Sort;

$sort = new Sort([
    'attributes' => [
        'age',
        'name' => [
            'asc' => ['Nama' => SORT_ASC],
           
            'default' => SORT_DESC,
            'label' => 'Nama',
        ],
    ],
]);

$this->title = 'Data Guru';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">
	
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
				<?= Html::a('Input Guru', ['/pegawai/create'], ['class' => 'btn btn-success pull-right']) ?>
			</h1>
		</div>
		<div class='box-body no-padding'>
			<?= $this->render('_search',['model' => $searchModel]);?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'bordered' => false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'label' => '',
						'attribute' => '',
						'format' => 'raw',
						'headerOptions' => ['style' => 'width:80px'],
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$model->biodata->Foto,['class' => 'img-responsive img-grid']);
						},
					],

					[
						'label' => 'Nama',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a('<strong>'.strtoupper($model->biodata->Nama).'</strong><i> '.$model->biodata->GelarDepan.','.$model->biodata->GelarBelakang.'</i><br/>NIP : '.$model->NIP,['view','id' => $model->Id]);
						},
					],
					
					[
						'label' => 'Alamat',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->biodata->Alamat;
						},
					],
					[
						'label' => 'Telepon',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->biodata->Telepon.' '.$model->biodata->HP;
						},
					],

					[
						'label' => 'Action',
						'attribute' => '',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							
							return '<div class="btn-group">
								  <button type="button" class="btn btn-default dropdown-toggle btn-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="fa fa-bars"></span>
								  </button>
								  <ul class="dropdown-menu">
									<li>'.Html::a('Tampilkan',['view','id'=> $model->Id]).'</li>
									<li>'.Html::a('Ubah',['/pegawai/update','id'=> $model->Id]).'</li>
									<li role="separator" class="divider"></li>
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
		</div>
	</div>
    
</div>
