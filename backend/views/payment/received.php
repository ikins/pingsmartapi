<?php

use yii\helpers\Html;
use kartik\grid\GridView;


$this->title = 'Pembayaran Diterima';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">
	
	<div class='box box-widget'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
			</h1>
		</div>
		<div class='box-body no-padding'>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'bordered' => false,
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
						'label' => 'Nama',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a($model->member->Nama,['/member/view','id' => $model->member->Id]);
						},
					],
					[
						'label' => 'Jenis Pembayaran',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a($model->type->Type,['view','id' => $model->Id]);
						},
					],
					[
						'label' => 'Jumlah',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Yii::$app->formatter->asDecimal($model->Jumlah);
						},
					],
					
					[
						'label' => 'Bank',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->bank->Bank;
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
					
					
					[
						'label' => 'Action',
						'attribute' => 'Id',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return '<div class="btn-group">
									  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-bars"></i>
									  </button>
									  <ul class="dropdown-menu">
										<li>'.Html::a('Tampilkan',['view','id' => $model->Id]).'</li>
										<li>'.Html::a('Edit',['update','id' => $model->Id]).'</li>
										<li>'.Html::a('Hapus',['delete','resi' => $model->Id],[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
												'data-method' => 'post',
												]).'</li>
										
									  </ul>
									</div>';
						},
					],
					
					[
						'label' => 'Bank Asal',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->BankAsal.' '.$model->RekeningAsal.' '.$model->NamaRekAsal;
						},
					],
				],
			]); ?>
		</div>
		
	</div>
    
</div>
