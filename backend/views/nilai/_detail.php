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
		[
			'label' => 'Hapus',
			'attribute' => '',
			'format' => 'raw',
			'vAlign' => 'middle',
			'value' => function ($model, $key, $index) {
				return '<button class="btn btn-xs btn-danger" id="btn-select_'.$model->Id.'" name="'.$model->Id.'"><i class="fa fa-trash"></i></button>';
			}, 
		],
	],
	]); ?>
</div>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#mdNilai"><i class='fa fa-check'></i> Input Nilai</button>


<?php
Modal::begin([
	'id' => 'mdNilai',
	'header' => '<h5>Input Nilai</h5>',
	'options'=>[
		'data-url'=>'cubic',
		],
]);
?>
<div class='row'>
	<div class='col-sm-12'>
		
		<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'id' => 'nilaiform']); ?>
		<input type='hidden' name='Kode' value='<?=$model->Kode;?>'>
		<input type='hidden' name='KodePel' value='<?=$model->KodePel;?>'>
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Nama Siswa
			</div>
			<div class='col-sm-9'>
				<?= Html::dropDownList('NIS',null,ArrayHelper::map(Siswa::find()->where(['KodeKelas' => $model->KodeKelas])->all(), 'NIS', 'biodata.Nama'),['prompt'=>'- Pilih Siswa -','class' => 'form-control','id' => 'nis']);?>
			</div>
		</div>
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Nilai
			</div>
			<div class='col-sm-9'>
				<?= Html::textInput('Nilai',null,['class' => 'form-control','id' => 'nilai']);?>
			</div>
		</div>
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Status Nilai
			</div>
			<div class='col-sm-9'>
				<?= Html::dropDownList('IdStat',null,ArrayHelper::map(NilaiStatus::find()->all(), 'Id', 'Status'),['prompt'=>'- Pilih Status -','class' => 'form-control','id' => 'idstat']);?>
			</div>
		</div>
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Keterangan
			</div>
			<div class='col-sm-9'>
				<?= Html::textInput('Keterangan',null,['class' => 'form-control','id' => 'remarks']);?>
			</div>
		</div>
		
		
		<div class="row rowlist">
			<div class='col-sm-12'>
				<button class='btn btn-primary pull-right' id='btn-save' type='button'>Save</button>
			</div>
		</div>
		
		<div class="row rowlist" id='status-ajax'>
			<div class='col-sm-12'>
			<div class="hide alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b><i class="icon fa fa-check"></i> Data Berhasil Ditambahkan</b>
			</div>
			</div>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
	
</div>

<?php Modal::end();?>

<?php

$urlInc = Url::to(['/nilai/add-detail']);
$urlDel = Url::to(['/nilai/remove-detail']);
$script = <<< JS
	
	function saveNilai(){
		$.ajax({
			type: 'POST',
			url: '{$urlInc}',
			data: $('#nilaiform').serialize(),
			dataType: 'json',
			success: function (data) {
				if(data !== null){
					var res = JSON.parse(JSON.stringify(data));
					if (res.Status = 1){
						$('#status-ajax div').removeClass('hide');
					}
					setTimeout(function () {
						$("#nilai-list").load(location.href+" #nilai-list","");
						$("#nilaiform")[0].reset();
						}, 10);
				}
			}
			
		});
	}
	
	$('#btn-save').click(function(){
		saveNilai();
		$('.close').click();
		});
		
	
	function deleteItem(id){
		$.ajax({
			type: 'POST',
			url: '{$urlDel}',
			data: {id: id},
			dataType: 'json',
			success: function (data) {
				if(data !== null){
					setTimeout(function () {
						$("#nilai-list").load(location.href+" #nilai-list","");
						}, 10);
				}
					
			},
			
		});
		
	}
	
	//setiap select button, sikat data dest nya bro
	$('[id*=btn-select_').click(function(){
		deleteItem(this.name);
		});
	
JS;
$this->registerJs($script);
?>