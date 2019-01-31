<?php

use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Nilai';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-index">
	
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
				<?= Html::a('Input Nilai', ['create'], ['class' => 'btn btn-success pull-right']) ?>
			</h1>
		</div>
		<div class='box-body no-padding'>
			<?= $this->render('_search',['model' => $searchModel]);?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'label' => 'Kode',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a($model->Kode,['view','id' => $model->Id]);
						},
					],
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
						'label' => 'Jenis',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->jenis->Jenis;
						},
					],
					[
						'label' => 'Pelajaran',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->pelajaran->Pelajaran;
						},
					],
					[
						'label' => 'Kelas',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'group' => true,
						'groupedRow'=>true,                    
						'groupOddCssClass'=>'kv-grouped-row',  
						'groupEvenCssClass'=>'kv-grouped-row', 
						'value' => function ($model, $key, $index) { 
							return 'Kelas '.Html::a($model->kelas->Kelas,['/kelas/view','id' => $model->kelas->Id]);
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
									<li>'.Html::a('Ubah',['update','id'=> $model->Id]).'</li>
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
		</div>
	</div>
    
</div>
