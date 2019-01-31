<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\PelajaranGroup;

?>

<div class="pelajaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'Pelajaran',['inputOptions' => ['placeholder' => 'Ketik Nama Siswa','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-3'>
			<?= $form->field($model, 'IdGroup')->dropDownList(ArrayHelper::map(PelajaranGroup::find()->all(), 'Id', 'Group'),['prompt'=>'- Semua Group -'])->label(false)?>
		</div>
		<div class='col-sm-3'>
			 <?= Html::submitButton('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>

    
    <?php ActiveForm::end(); ?>

</div>
