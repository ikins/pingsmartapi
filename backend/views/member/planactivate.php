<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Plan;
use yii\helpers\Url;


$this->title = 'Aktifkan Paket';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-create">

    <?php $form = ActiveForm::begin(); ?>
		
	<div class='row'>
		<div class='col-sm-6 col-md-5'>
			<div class='box box-widget'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kode Member
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'MemberId')->textInput(['maxlength' => true,'readonly' => true])->label(false) ?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Kode Member
						</div>
						<div class='col-sm-9'>
							<div class='form-group form-control'><?= $model->member->Nama;?></div>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Paket 
						</div>
						<div class='col-sm-9'>
							 <?= $form->field($model, 'Kode')->dropDownList(ArrayHelper::map(Plan::find()->all(), 'Kode', 'Plan'),[
									'prompt'=>'- Pilih Paket -'])->label(false)?>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Durasi 
						</div>
						<div class='col-sm-9'>
							 <div class='row'>
								<div class='col-sm-3'>
									<div class='form-group form-control' id='durasi'></div>
								</div>
								<div class='col-sm-3 label-div'>
									Harga
								</div>
								<div class='col-sm-6'>
									<div class='form-group form-control' id='harga'></div>
								</div>
							 </div>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-sm-3 label-div'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
				</div>
				<div class='box-footer'>
					<?= Html::submitButton($model->isNewRecord ? 'Aktifkan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary pull-right']) ?>
				</div>
			</div>
		</div>
	</div>
	
	
    <?php ActiveForm::end(); ?>

</div>


<?php

$urlPlan = Url::to(['/plan/getdata']);
$script = <<< JS
	
	function checkPaket(kode){
		$.ajax({
			type: 'POST',
			url: '{$urlPlan}',
			data: {kode:kode},
			dataType: 'json',
			success: function (data) {
				
				var res = JSON.parse(JSON.stringify(data));
				$('#durasi').html(res[0].Durasi);
				$('#harga').html(res[0].Harga);
			}
			
		});
	}
	
	$('#memberrecord-kode').change(function(){
		checkPaket($(this).val());
	});
	
	
	
JS;
$this->registerJs($script);
?>
