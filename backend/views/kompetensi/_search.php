<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ProgramStudi;
?>

<div class="kompetensi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'Kompetensi',['inputOptions' => ['placeholder' => 'Kompetensi','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-3'>
			<?= $form->field($model, 'IdProdi')->dropDownList(ArrayHelper::map(ProgramStudi::find()->all(), 'Id', 'ProgramStudi'),[
										'prompt'=>'- Pilih ProgramStudi Studi -'])->label(false)?>
		</div>
		
		<div class='col-sm-4'>
			 <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>
   
   
    <?php ActiveForm::end(); ?>

</div>
