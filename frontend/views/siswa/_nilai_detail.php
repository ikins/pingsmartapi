<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\NilaiDetailSearch;
use common\models\Siswa;
use common\models\NilaiStatus;

$searchModel = new NilaiDetailSearch(['Kode' => $model->Kode]);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<div id='nilai-list'>
<?= GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'columns' => [
		['class' => 'kartik\grid\SerialColumn'],

		[
			'label' => 'NIS',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return $model->NIS;
			}, 
		],
		[
			'label' => 'Nama',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return $model->siswa->biodata->Nama;
			}, 
		],
		[
			'label' => 'Nilai',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return $model->Nilai;
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
	],
	]); ?>
</div>