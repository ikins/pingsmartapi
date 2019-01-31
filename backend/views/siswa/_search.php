<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Kelas;

?>

<div class="siswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'Nama',['inputOptions' => ['placeholder' => 'Ketik Nama Siswa','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-2'>
			<?= $form->field($model, 'NIS',['inputOptions' => ['placeholder' => 'Ketik NIS','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-3'>
			<?= $form->field($model, 'KodeKelas')->dropDownList(ArrayHelper::map(Kelas::find()->all(), 'Kode', 'Kelas'),['prompt'=>'- Semua Kelas -'])->label(false)?>
		</div>
		<div class='col-sm-3'>
			 <?= Html::submitButton('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
