<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Blokir Galery';
$this->params['breadcrumbs'][] = ['label' => 'Galery Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galery-album-view">

    <div class='row'>
		<div class='col-md-8'>
			<div class='box box-widget'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					<div class='row'>
						<div class='col-sm-8'>
							<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/'.$model->Image,['class' => 'img img-responsive']);?>
						</div>
						<div class='col-sm-4'>
							<h4><?= $model->Judul;?></h4>
							<?=$model->Deskripsi;?>
							<br/>
							<span class='pull-right tb-subrow'>Upload By: <?= Yii::$app->formatter->asDateTime($model->UploadTime);?></span>
							<hr/>
							<div class='row rowlist'>
								<div class='col-sm-12'>
									<label>Upload By</label><br/>
									<?= $model->member->Nama;?>
								</div>
							</div>
							<hr/>
							<div class='row rowlist'>
								<div class='col-sm-12'>
									<label>Album</label><br/>
									<?= $model->album->Album;?>
								</div>
							</div>
							
							<hr/>
							<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
							<div class='row rowlist'>
								<div class='col-sm-12'>
									<label>Alasan Pemblokiran</label><br/>
									<?= $form->field($model, 'Remarks')->textArea(['rows' => 3])->label(false) ?>
									<?= Html::submitButton('<i class="fa fa-warning"></i> Blokir', ['class' => 'btn btn-warning']) ?>
								</div>
							</div>
							<?php ActiveForm::end(); ?>
							
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>

</div>
