<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'Nama',['inputOptions' => ['placeholder' => 'Ketik Nama Pegawai','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-3'>
			 <?= Html::submitButton('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>


    <?php ActiveForm::end(); ?>

</div>
