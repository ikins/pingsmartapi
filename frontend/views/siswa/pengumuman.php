<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\MemberLevel;
use common\models\Kelas;
$this->title = 'Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Siswa', 'url' => ['/member/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='member-index'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuSiswa');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'>
					<?= $this->title;?>
				</h1>
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
								return Html::a($model->Judul,['/siswa/pengumuman-view','id' => $model->Id]);
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

