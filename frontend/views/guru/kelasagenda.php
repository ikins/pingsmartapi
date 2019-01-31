<?php
use yii\helpers\Html;
use common\models\Kelas;
use common\models\SiswaBiodata;

$this->title='Agenda Kelas';
use kartik\grid\GridView;
?>
<div class='container'>
	<div class='row'>
		<div class='col-sm-3'>
			<?= $this->render('/member/_menuGuru');?>
			
		</div>
		<div class='col-sm-9'>
			<h1 class='page-header'><?= $this->title;?>
			<?= Html::a('Buat Agenda',['/guru/kelasagenda-add'],['class' => 'btn btn-primary pull-right up10']);?>
			</h1>
			<?= GridView::widget([
					'dataProvider' => $dataProvider,
					//'filterModel' => $searchModel,
					'columns' => [
						['class' => 'kartik\grid\SerialColumn'],

						[
							'label' => 'Judul',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) { 
								return Html::a($model->Judul,['/guru/kelasagenda-view','id' => $model->Id]);
							},
						],
												
						[
							'label' => 'Kelas',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) { 
								$str='';
								$target=json_decode($model->KodeKelas);
								if (count($target) > 0){
									$kelas=Kelas::find()->where(['in','Kode',$target])->all();
									foreach($kelas as $k){$str=$str.$k->Kelas.', ';}
								
								}
								return $str;
							},
						],
						
						[
							'label' => 'Target Siswa',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) { 
								$str='';
								$siswa=json_decode($model->NIS);
								if (count($siswa) > 0){
									$siswa=SiswaBiodata::find()->where(['in','NIS',$siswa])->limit(2)->all();
									foreach($siswa as $s){
										$str=$str.$s->Nama.', ';
										}
								
								}
								return $str.'...';
							},
						],
						
						[
							'label' => 'Tanggal Kegiatan',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) { 
								return Yii::$app->formatter->asDate($model->TglAwal).' - '.Yii::$app->formatter->asDate($model->TglAkhir);
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