<?php

use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Pelanggaran Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-record-index">
	
	<div class='box box-widget'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
				<?= Html::a('Catat Pelanggaran', ['create'], ['class' => 'btn btn-success pull-right']) ?>
			</h1>
		</div>
		<div class='box-body no-padding'>
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
							return Html::a(Yii::$app->formatter->asDate($model->Tanggal),['view','id' => $model->Id]);
						},
					],
					[
						'label' => 'Nama Siswa',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a('<strong>'.$model->siswa->biodata->Nama.'</strong>',['view','id' => $model->Id]);
						},
					],
					[
						'label' => 'Pelanggaran',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->pelanggaran->Pelanggaran;
						},
					],
					[
						'label' => 'Kategori',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->pelanggaran->kategori->Kategori;
						},
					],
					[
						'label' => 'Demote',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->Point. ' Point';
						},
					],
					[
						'label' => 'Credit Point',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->siswa->Point. ' Point';
						},
					],
					[
						'label' => 'Keterangan',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->Keterangan;
						},
					],
					[
						'label' => 'Pelapor',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->pegawai->biodata->Nama;
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
				],
			]); ?>
		</div>
		<div class='box-footer'>
		</div>
	</div>
   
</div>
