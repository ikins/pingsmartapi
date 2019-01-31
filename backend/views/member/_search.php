<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MemberLevel;
?>

<div class="member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'Nama',['inputOptions' => ['placeholder' => 'Cari Member','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-3'>
			<?= $form->field($model, 'IdLev')->dropDownList(ArrayHelper::map(MemberLevel::find()->all(), 'Id', 'Level'),['prompt'=>'- Level Member -'])->label(false)?>
		</div>
		<div class='col-sm-3'>
			 <?= Html::submitButton('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
