<?php

use yii\helpers\Html;
$this->title = $model->Judul;
$this->params['breadcrumbs'][] = ['label' => 'Galery Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galery-album-view">

    <div class='row'>
		<div class='col-md-8'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					<div class='row'>
						<div class='col-sm-8'>
							<?php if($model->IdStat ==4):?>
							<div class="ribbon-top-left">
								<div class="txt">
									BLOKIR
								</div>
							</div>
							<?php endif;?>
							<?php if($model->IdStat ==4):?>
									<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/'.$model->Image,['class' => 'img img-responsive img-gray']);?>
								<?php else:?>
									<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/'.$model->Image,['class' => 'img img-responsive']);?>
								<?php endif;?>
							
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
						</div>
					</div>
					
				</div>
				<div class='box-footer'>
					<?= Html::a('<i class="fa fa-pencil"></i> Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
					<?= Html::a('<i class="fa fa-ban"></i> Blokir', ['bann', 'id' => $model->Id], ['class' => 'btn btn-warning']) ?>
					<?= Html::a('<i class="fa fa-close"></i> Delete', ['delete', 'id' => $model->Id], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => 'Are you sure you want to delete this item?',
							'method' => 'post',
						],
					]) ?>
				</div>
			</div>
		</div>
	</div>

</div>
