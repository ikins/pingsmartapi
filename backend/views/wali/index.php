<?php

use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Wali';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wali-index">
	<div class='box box-widget'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title) ?>
				
			</h1>
		</div>
		<div class='box-body no-padding'>
			<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'bordered' => false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					//Id',
					[
						'label' => 'Siswa',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'group' => true,
						'groupedRow'=>true,                    
						'groupOddCssClass'=>'kv-grouped-row',  
						'groupEvenCssClass'=>'kv-grouped-row', 
						'value' => function ($model, $key, $index) { 
							return Html::a($model->siswa->biodata->Nama,['/siswa/view','id' => $model->siswa->Id]);
						},
					],
					[
						'label' => 'Nama',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a($model->wali->Nama,['view','id' => $model->wali->Id]);
						},
					],
					[
						'label' => 'Alamat',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->wali->Alamat.' '.$model->wali->kabupaten->Kabupaten;
						},
					],
					[
						'label' => 'Provinsi',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->wali->provinsi->Provinsi;
						},
					],
					[
						'label' => 'Telepon',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->wali->Telepon.'  '.$model->wali->HP;
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
  									<li>'.Html::a('Tampilkan',['view','id'=> $model->wali->Id]).'</li>
  									<li>'.Html::a('Ubah',['update','id'=> $model->wali->Id]).'</li>
  									<li role="separator" class="divider"></li>
  									<li>'.Html::a('Hapus',['/siswawali/delete','id' => $model->Id],[
  												'title' => Yii::t('yii', 'Delete'),
  												'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
  												'data-method' => 'post',
  												]).'</li>
  								  </ul>
  								</div>';

  						},

  					],
					[
						'label' => 'Keterangan',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->wali->Keterangan;
						},
					],
				],
			]); ?>
		</div>
	</div>
   
    
</div>
