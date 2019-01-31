<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\PelanggaranKategori;
?>

<div class="pelanggaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='row p10'>
		
		<div class='col-sm-3'>
			<?= $form->field($model, 'Pelanggaran',['inputOptions' => ['placeholder' => 'Cari Pelanggaran','class' => 'form-control']])->label(false) ?>
		</div>
		<div class='col-sm-3'>
			<?= $form->field($model, 'IdKat')->dropDownList(ArrayHelper::map(PelanggaranKategori::find()->all(), 'Id', 'Kategori'),['prompt'=>'- Pilih Kelas -'])->label(false)?>
		</div>
		
		<div class='col-sm-4'>
			 <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			 <?= Html::a('Reset',['index'],['class' => 'btn btn-default']);?>
		</div>
	</div>
    
    <?php ActiveForm::end(); ?>

</div>
