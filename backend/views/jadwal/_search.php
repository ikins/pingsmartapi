<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Kelas;
?>

<div class="jadwal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'KodeKelas')->dropDownList(ArrayHelper::map(Kelas::find()->all(), 'Kode', 'Kelas'),[
										'prompt'=>'- Pilih Kelas -'])->label(false)?>
		</div>
		<div class='col-sm-3'>
			<?= $form->field($model, 'Pelajaran',['inputOptions' => ['placeholder' => 'Ketik Pelajaran','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-4'>
			 <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>
   
    <?php ActiveForm::end(); ?>

</div>
