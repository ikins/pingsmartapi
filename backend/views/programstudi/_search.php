<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\BidangStudi;

?>

<div class="program-studi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'ProgramStudi',['inputOptions' => ['placeholder' => 'Program Studi','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-3'>
			<?= $form->field($model, 'IdBidang')->dropDownList(ArrayHelper::map(BidangStudi::find()->all(), 'Id', 'Bidang'),[
										'prompt'=>'- Pilih Bidang Studi -'])->label(false)?>
		</div>
		
		<div class='col-sm-4'>
			 <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>
   
    <?php ActiveForm::end(); ?>

</div>
