<?php
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Nilai Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Guru', 'url' => ['/member/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='member-index'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuSiswa');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'>
					<?= $this->title;?>
				</h1>
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
							return Html::a($model->Kode,['/siswa/nilai-view','id' => $model->Id]);
						},
					],
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
						'label' => 'Pelajaran',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->pelajaran->Pelajaran;
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
										
					
				],
			]); ?>
				
			</div>
		</div>
	</div>
</div>

