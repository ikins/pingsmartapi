<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Pekerjaan;
use common\models\Provinsi;
use common\models\Kabupaten;
use common\models\FamilyStatus;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>

<div id='wali-list'>
	<?= $this->render('_walilist',['model' => $model]);?>
</div>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#mdWali"><i class='fa fa-check'></i> Input Wali</button>


<?php
Modal::begin([
	'id' => 'mdWali',
	'header' => '<h5>Input Wali</h5>',
	'options'=>[
		'data-url'=>'cubic',
		],
]);
?>
<div class='row'>
	<div class='col-sm-12'>
		
		<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'id' => 'waliform']); ?>
		<input type='hidden' name='nis' value='<?=$model->NIS;?>'>
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Nama
			</div>
			<div class='col-sm-9'>
				<?= Html::textInput('Nama',null,['class' => 'form-control','id' => 'remarks']);?>
			</div>
		</div>
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Pekerjaan
			</div>
			<div class='col-sm-9'>
				<?= Html::dropDownList('IdJob',null,ArrayHelper::map(Pekerjaan::find()->all(), 'Id', 'Pekerjaan'),['prompt'=>'- Pilih Pekerjaan -','class' => 'form-control','id' => 'idjob']);?>
			</div>
		</div>
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Alamat
			</div>
			<div class='col-sm-9'>
				<?= Html::textArea('Alamat',null,['class' => 'form-control','id' => 'alamat']);?>
			</div>
		</div>
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Kota
			</div>
			<div class='col-sm-9'>
				<div class='row'>
					<div class='col-sm-7'>
						<?= Html::textInput('Kota',null,['class' => 'form-control','id' => 'kota']);?>
					</div>
					<div class='col-sm-2 label-div'>
						Pos
					</div>
					<div class='col-sm-3'>
						<?= Html::textInput('Pos',null,['class' => 'form-control','id' => 'pos']);?>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Provinsi
			</div>
			<div class='col-sm-9'>
				<?= Html::dropDownList('IdProv',null,ArrayHelper::map(Provinsi::find()->all(), 'Id', 'Provinsi'),[
					'prompt'=>'- Pilih Provinsi -',
					'onchange'=>'
							$.get("'.Url::toRoute('kabupaten/find-by-prov').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $("select#idkab" ).html( data );
								});
							
						'
					,'class' => 'form-control']);?>
			</div>
		</div>

		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Kabupaten
			</div>
			<div class='col-sm-9'>
				<?= Html::dropDownList('IdKab',null,ArrayHelper::map(Kabupaten::find()->all(), 'Id', 'Kabupaten'),['prompt'=>'- Pilih Kabupaten -','class' => 'form-control','id' => 'idkab']);?>
			</div>
		</div>
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Telepon
			</div>
			<div class='col-sm-9'>
				<div class='row'>
					<div class='col-sm-6'>
						<?= Html::textInput('Telepon',null,['class' => 'form-control','id' => 'telepon']);?>
					</div>
					<div class='col-sm-2 label-div'>
						HP
					</div>
					<div class='col-sm-4'>
						<?= Html::textInput('HP',null,['class' => 'form-control','id' => 'hp']);?>
					</div>
				</div>
			</div>
		</div>
		
		<div class='row rowlist'>
			<div class='col-sm-3 label-div'>
				Status Wali
			</div>
			<div class='col-sm-9'>
				<?= Html::dropDownList('IdFam',null,ArrayHelper::map(FamilyStatus::find()->all(), 'Id', 'Status'),['prompt'=>'- Pilih Status -','class' => 'form-control','id' => 'idstat']);?>
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
				<button class='btn btn-primary pull-right' id='btn-savewali' type='button'>Save</button>
			</div>
		</div>
		
		<div class="row rowlist" id='status-ajax'>
			<div class='col-sm-12'>
			<div class="hide alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b><i class="icon fa fa-check"></i> Data Wali Berhasil Ditambahkan</b>
			</div>
			</div>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
	
</div>

<?php Modal::end();?>

<?php

$urlInc = Url::to(['/siswa/add-wali']);
$script = <<< JS
	
	function saveWali(){
		$.ajax({
			type: 'POST',
			url: '{$urlInc}',
			data: $('#waliform').serialize(),
			dataType: 'json',
			success: function (data) {
				if(data !== null){
					var res = JSON.parse(JSON.stringify(data));
					if (res.Status = 1){
						$('#status-ajax div').removeClass('hide');
					}
					setTimeout(function () {
						$("#wali-list").load(location.href+" #wali-list","");
						$("#waliform")[0].reset();
						}, 10);
				}
			}
			
		});
	}
	
	$('#btn-savewali').click(function(){
		saveWali();
		$('.close').click();
		});
	
JS;
$this->registerJs($script);
?>