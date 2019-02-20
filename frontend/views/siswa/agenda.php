<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\MemberLevel;
use common\models\Kelas;
$this->title = 'Agenda';
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
							'label' => 'Judul',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) { 
								return Html::a($model->Judul,['/siswa/agenda-view','id' => $model->Id]);
							},
						],
						[
							'label' => 'Tanggal Awal',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) { 
								return Yii::$app->formatter->asDate($model->TglAwal);
							},
						],
						[
							'label' => 'Tanggal Akhiar',
							'attribute' => '',
							'format' => 'raw',
							'vAlign' => 'middle',
							'value' => function ($model, $key, $index) { 
								return Yii::$app->formatter->asDate($model->TglAkhir);
							},
						],

					],
				]); ?>
				
			</div>
		</div>
	</div>
</div>

