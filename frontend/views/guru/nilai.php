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
				<?= $this->render('/member/_menuGuru');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'>
					<?= $this->title;?>
					<?= Html::a('Input Nilai',['/guru/nilai-add'],['class' => 'btn btn-primary pull-right up10']);?>
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
							return Html::a($model->Kode,['/guru/nilai-view','id' => $model->Id]);
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
							return 'Kelas '.Html::a($model->kelas->Kelas,['/guru/siswa','id' => $model->kelas->Id]);
						},
					],
										
					
				],
			]); ?>
				
			</div>
		</div>
	</div>
</div>

