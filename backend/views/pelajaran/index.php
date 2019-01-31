<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Data Pelajaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajaran-index">

    <div class='box box-warning'>
      <div class='box-header with-border'>
        <h1>
          <?= Html::encode($this->title) ?>
  				<?= Html::a('Input Pelajaran', ['create'], ['class' => 'btn btn-success pull-right']) ?>
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
			['class' => 'kartik\grid\SerialColumn'],

            [
  						'label' => 'KODE',
  						'attribute' => '',
  						'format' => 'raw',
  						'vAlign' => 'middle',
  						'value' => function ($model, $key, $index) {
  							return Html::a($model->Kode,['view','id' => $model->Id]);
  						},
  					],
            [
  						'label' => 'PELAJARAN',
  						'attribute' => '',
  						'format' => 'raw',
  						'vAlign' => 'middle',
  						'value' => function ($model, $key, $index) {
  							return Html::a($model->Pelajaran,['view','id' => $model->Id]);
  						},
  					],
            [
  						'label' => 'GRUP',
  						'attribute' => '',
  						'format' => 'raw',
  						'vAlign' => 'middle',
						'group' => true,
						'groupedRow'=>true,                    
						'groupOddCssClass'=>'kv-grouped-row',  
						'groupEvenCssClass'=>'kv-grouped-row', 
  						'value' => function ($model, $key, $index) {
  							return $model->group->Group;
  						},
  					],
            [
  						'label' => 'KETERANGAN',
  						'attribute' => '',
  						'format' => 'raw',
  						'vAlign' => 'middle',
  						'value' => function ($model, $key, $index) {
  							return $model->Keterangan;
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
    </div>

</div>
