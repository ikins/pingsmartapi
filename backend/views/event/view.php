<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detail Event';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">
	
	<div class='row'>
		<div class='col-sm-6'>
			<div class='box box-widget'>
				<div class='box-header with-border'>
					<h1>
						<?= $model->Event; ?>
					</h1>
				</div>
				<div class='box-body'>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Tanggal
						</div>
						<div class='col-sm-9'>
							<?= Yii::$app->algo->tglIndoNoTime($model->Tanggal).' '.substr($model->JamMulai,0,5).' WIB s.d. ';?> 
							<?php if (!$model->Tanggal == $model->TanggalAkhir):?>
								<?= Yii::$app->algo->TanggalIndoNoTime($model->TanggalAkhir).' ';?>
							<?php endif;?>
							<?= substr($model->JamSelesai,0,5);?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Tempat
						</div>
						<div class='col-sm-9'>
							<?= $model->Tempat;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-12'>
							Deskripsi : 
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-12'>
							<div class='attachment-block'><?= $model->Deskripsi;?></div>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Status
						</div>
						<div class='col-sm-9'>
							<?= $model->status->Status;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-12'>
							Keterangan :
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-12'>
							<div class='attachment-block'><?= $model->Keterangan;?></div>
						</div>
					</div>
					
				</div>
				<div class='box-footer'>
					<?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
					<?= Html::a('Delete', ['delete', 'id' => $model->Id], [
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
