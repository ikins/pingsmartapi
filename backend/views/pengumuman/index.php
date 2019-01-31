<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\MemberLevel;
use common\models\Kelas;

$this->title = 'Pengumuman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengumuman-index">
	
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
				<?= Html::a('Create Pengumuman', ['create'], ['class' => 'btn btn-success pull-right']) ?>
			</h1>
		</div>
		<div class='box-body no-padding'>
			 <?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
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
						'label' => 'Judul',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Html::a($model->Judul,['view','id' => $model->Id]);
						},
					],
					[
						'label' => 'Target Audience',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							$str='';
							$target=json_decode($model->Target);
							if (count($target) > 0){
								$level=MemberLevel::find()->where(['in','Id',$target])->all();
								foreach($level as $l){$str=$str.$l->Level.', ';}
							
							}
							return $str;
						},
					],
					
					[
						'label' => 'Target Kelas',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							$str='';
							$kelas=json_decode($model->KodeKelas);
							if (count($kelas) > 0){
								$kls=Kelas::find()->where(['in','Kode',$kelas])->all();
								foreach($kls as $k){$str=$str.$k->Kelas.', ';}
							
							}
							return $str;
						},
					],
					
					[
						'label' => 'Publikasi',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Yii::$app->formatter->asDate($model->BeginPublish).' - '.Yii::$app->formatter->asDate($model->EndPublish);
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
