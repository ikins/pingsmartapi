<?php
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Pelanggaran Siswa';
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
					<?= Html::a('Input Pelanggaran',['/guru/pelanggaran-add'],['class' => 'btn btn-primary pull-right up10']);?>
				</h1>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'bordered' => false,
				'hover' => true,
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
						'label' => 'Nama Siswa',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a('<strong>'.$model->siswa->biodata->Nama.'</strong>',['/guru/siswaview','id' => $model->siswa->Id]).'<br/><span class="submenu-link">Kelas '.$model->siswa->KodeKelas.'</span>';
						},
					],
					[
						'label' => 'Pelanggaran',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->pelanggaran->Pelanggaran.'<br/><span class="submenu-link">Pelanggaran '.$model->pelanggaran->kategori->Kategori.'</span>';
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
						'label' => 'Sisa Point',
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
					
				],
			]); ?>
				
			</div>
		</div>
	</div>
</div>

