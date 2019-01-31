<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Member Diblokir';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">
	
	<div class='box box-widget'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
			</h1>
		</div>
		<div class='box-body no-padding'>
			<?php echo $this->render('_search', ['model' => $searchModel]); ?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'bordered' => false,
				'hover' => true,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'label' => '',
						'attribute' => '',
						'format' => 'raw',
						'headerOptions' => ['style' => 'width:80px'],
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$model->Avatar,['class' => 'img-responsive img-grid ']);
						},
					],
					[
						'label' => 'Nama',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a('<strong>'.strtoupper($model->Nama).'</strong><br/>MemberID : '.$model->MemberId,['view','id' => $model->Id]);
						},
					],
					[
						'label' => 'Level',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->level->Level;
						},
					],
					
					[
						'label' => 'Status',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							
							switch ($model->IdStat){
								
								case 1:
									$class='default';
									break;
								case 2:
									$class='info';
									break;
								case 3:
									$class='success';
									break;
								case 4:
									$class='warning';
									break;
								case 5:
									$class='warning';
									break;
								case 6:
									$class='danger';
									break;
							}
							
							return '<div class="label label-'.$class.' label-md">'.$model->status->Status.'</span>';
						},
					],
					
					[
						'label' => 'Masa Aktif',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'hAlign' => 'right',
						'value' => function ($model, $key, $index) { 
							return $model->RemainPeriode.' <span class="dark-gray">hari</span>';
						},
					],
					
					[
						'label' => 'Expired Date',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							if($model->ExpiredDate != '0000-00-00'){return Yii::$app->formatter->asDate($model->ExpiredDate);}else{return '';}
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
									<li>'.Html::a('UnBlock',['unblock','id' => $model->Id],[
												'title' => Yii::t('yii', 'Blokir'),
												'data-confirm' => Yii::t('yii', 'Yakin akan memblokir '.$model->Nama.'?'),
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
