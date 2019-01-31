<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'Event',['inputOptions' => ['placeholder' => 'Ketik Nama Kegiatan','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-3'>
			<div class='row'>
				<div class='col-sm-6'>
					<?= $form->field($model, 'Awal')->widget(DatePicker::classname(), [
						'options' => ['placeholder' => 'dari tanggal'],
						'removeButton' => false,
						'pluginOptions' => [
							'autoclose'=>true,
							'format' => 'yyyy-mm-dd'
						]
					])->label(false);?>
				</div>
				<div class='col-sm-6'>
					<?= $form->field($model, 'Akhir')->widget(DatePicker::classname(), [
						'options' => ['placeholder' => 's.d. tanggal'],
						'removeButton' => false,
						'pluginOptions' => [
							'autoclose'=>true,
							'format' => 'yyyy-mm-dd'
						]
					])->label(false);?>
				</div>
			</div>
		</div>
		<div class='col-sm-3'>
			 <?= Html::submitButton('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>
    <?php ActiveForm::end(); ?>

</div>
