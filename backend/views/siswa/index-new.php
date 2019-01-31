<?php

use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Data Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">
	
	<div class='box box-warning'>
		<div class='box-header with-border'>
			 <h1>
				<?= Html::encode($this->title) ?>
				<?= Html::a('Input Siswa', ['create'], ['class' => 'btn btn-success pull-right']) ?>
			</h1>
		</div>
		<div class='box-body no-padding'>
			
			<?= $this->render('_search',['model' => $searchModel]);?>
			
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
							return Html::a('<strong>'.strtoupper($model->biodata->Nama).'</strong><br/>NIS : '.$model->NIS.'<br/><span class="dark-gray bold">'.$model->Point.' points</span>',['view','id' => $model->Id]);
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
	</div>
</div>
