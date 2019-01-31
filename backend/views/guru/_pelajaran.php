<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use common\models\Pelajaran;
use common\models\Kelas;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<div class="guru-ajar">
	<div id='ajarlist'>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			//'filterModel' => $searchModel,
			'columns' => [
				
				[
					'label' => 'Mata Pelajaran',
					'attribute' => '',
					'format' => 'raw',
					'vAlign' => 'middle',
					'value' => function ($model, $key, $index) { 
						return $model->pelajaran->Pelajaran;
					},
				],
				[
					'label' => 'Kelas',
					'attribute' => '',
					'format' => 'raw',
					'vAlign' => 'middle',
					'value' => function ($model, $key, $index) { 
						return $model->kelas->Kelas;
					},
				],
				
			],
		]); ?>
	</div>
	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#mdAjar"><i class='fa fa-check'></i> Input Mata Pelajaran</button>
</div>



<?php
Modal::begin([
	'id' => 'mdAjar',
	'header' => '<h5>Input Mata Pelajaran</h5>',
	'options'=>[
		'data-url'=>'cubic',
		],
]);
?>
<div class='row'>
	<div class='col-sm-12'>
		
		<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'id' => 'pelform']); ?>
		<input type='hidden' name='IdPeg' value='<?=$guru->IdPeg;?>'>
		
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Mata Pelajaran
			</div>
			<div class='col-sm-9'>
				<?= Html::dropDownList('KodePel',null,ArrayHelper::map(Pelajaran::find()->all(), 'Kode', 'Pelajaran'),['prompt'=>'- Pilih Pelajaran -','class' => 'form-control','id' => 'kodepel']);?>
			</div>
		</div>
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Kelas
			</div>
			<div class='col-sm-9'>
				<?= Html::dropDownList('KodeKelas',null,ArrayHelper::map(Kelas::find()->all(), 'Kode', 'Kelas'),['prompt'=>'- Pilih Kelas -','class' => 'form-control','id' => 'kodekls']);?>
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
				<button class='btn btn-primary pull-right' id='btn-saveajar' type='button'>Save</button>
			</div>
		</div>
		
		<div class="row rowlist" id='status-ajax'>
			<div class='col-sm-12'>
			<div class="hide alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b><i class="icon fa fa-check"></i> Data Pengajaran Berhasil Ditambahkan</b>
			</div>
			</div>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
	
</div>

<?php Modal::end();?>


<?php

$urlPel = Url::to(['/guru/add-pelajaran']);
$script = <<< JS
	
	function savePel(){
		$.ajax({
			type: 'POST',
			url: '{$urlPel}',
			data: $('#pelform').serialize(),
			dataType: 'json',
			success: function (data) {
				if(data !== null){
					var res = JSON.parse(JSON.stringify(data));
					if (res.Status = 1){
						$('#status-ajax div').removeClass('hide');
					}
					setTimeout(function () {
						$("#ajarlist").load(location.href+" #ajarlist","");
						$("#pelform")[0].reset();
						}, 10);
				}
			}
			
		});
	}
	
	$('#btn-saveajar').click(function(){
		savePel();
		$('.close').click();
		});
		
JS;
$this->registerJs($script);
?>
