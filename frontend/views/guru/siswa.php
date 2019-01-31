<?php

use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Data Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">
	
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuGuru');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'><?= $this->title;?></h1>
				<?= $this->render('_siswa_search',['model' => $searchModel]);?>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					//'filterModel' => $searchModel,
					'hover' => true,
					'bordered' => false,
					'columns' => [
						//['class' => 'kartik\grid\SerialColumn'],
						
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
								return Html::a('<strong>'.strtoupper($model->biodata->Nama).'</strong><br/><div class="tb-subrow">NIS : '.$model->NIS.'<br/><span class="dark-gray bold">'.$model->Point.' points</span></div>',['/guru/siswaview','id' => $model->Id]);
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
								return $model->biodata->AlamatDom.'<br/>'.$model->biodata->domKab->Kabupaten;
							},
						],
						
					],
				]); ?>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
</div>
