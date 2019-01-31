<?php
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Jadwal Mengajar';
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
				<h1 class='page-header'><?= $this->title;?></h1>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					//'filterModel' => $searchModel,
					'hover' => true,
					'bordered' => false,
					'columns' => [
						
						[
							'label' => 'Jam',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) {
								return(substr($model->JamMulai,0,5).' - '.substr($model->JamAkhir,0,5));
							}, 
						],
						
						[
							'label' => 'HARI',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'group' => true,
							'groupedRow'=>true,                    
							'groupOddCssClass'=>'kv-grouped-row',  
							'groupEvenCssClass'=>'kv-grouped-row', 
							'value' => function ($model, $key, $index) {
								return($model->hari->Hari);
							}, 
						],
						
						
						[
							'label' => 'KELAS',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) {
								return Html::a('Kelas '.$model->KodeKelas, ['/guru/siswa', 'id' => $model->kelas->Id]);
							}, 
						],
						
						
						[
							'label' => 'Pelajaran',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) {
								return($model->pelajaran->Pelajaran);
							}, 
						],
						
					],
					]); ?>
			</div>
		</div>
	</div>
</div>

