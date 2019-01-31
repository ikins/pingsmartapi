<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detail Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-view">

    <div class='box box-widget'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
			</h1>
		</div>
		<div class='box-body'>
			
			<div class='row'>
				<div class='col-sm-8'>
					
					<div class='row row-list'>
						<div class='col-sm-3'>
							Tanggal
						</div>
						<div class='col-sm-9'>
							<?= Yii::$app->formatter->asDate($model->Tanggal);?>
						</div>
					</div>
					
					<div class='row row-list'>
						<div class='col-sm-3'>
							Dibayar Oleh
						</div>
						<div class='col-sm-9'>
							<?= $model->member->Nama;?>
						</div>
					</div>
					
					<div class='row row-list'>
						<div class='col-sm-3'>
							Kode Member
						</div>
						<div class='col-sm-9'>
							<?= $model->MemberId;?>
						</div>
					</div>
					
					<div class='row row-list'>
						<div class='col-sm-3'>
							Jenis Pembayaran
						</div>
						<div class='col-sm-9'>
							<?= $model->type->Type;?>
						</div>
					</div>
					
					<div class='row row-list'>
						<div class='col-sm-3'>
							Dibayar Via
						</div>
						<div class='col-sm-9'>
							<?= $model->model->Payment;?>
						</div>
					</div>
					
					<div class='row row-list'>
						<div class='col-sm-3'>
							Bank Tujuan
						</div>
						<div class='col-sm-9'>
							<?= $model->bank->Bank;?>
						</div>
					</div>
					
					<h5>Rekening Asal</h5>
					<div class='row row-list'>
						<div class='col-sm-3'>
							Bank Asal
						</div>
						<div class='col-sm-9'>
							<?= $model->BankAsal;?>
						</div>
					</div>
					<div class='row row-list'>
						<div class='col-sm-3'>
							Rekening Asal
						</div>
						<div class='col-sm-9'>
							<?= $model->RekeningAsal;?>
						</div>
					</div>
					<div class='row row-list'>
						<div class='col-sm-3'>
							Nama Rekening
						</div>
						<div class='col-sm-9'>
							<?= $model->NamaRekAsal;?>
						</div>
					</div>
					<div class='row row-list'>
						<div class='col-sm-3'>
							Jumlah
						</div>
						<div class='col-sm-9'>
							<?= Yii::$app->formatter->asDecimal($model->Jumlah);?>
						</div>
					</div>
					
					<div class='row row-list'>
						<div class='col-sm-3'>
							Keterangan
						</div>
						<div class='col-sm-9'>
							<?= $model->Keterangan;?>
						</div>
					</div>
					
				</div>
				<div class='col-sm-4'>
					<h4>Bukti Pembayaran</h4>
					<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/uploads/attachment/'.$model->Attachment,['class'=>'img img-responsive']) ?>
				</div>
			</div>
			
		</div>
		<div class='box-footer'>
			<?= Html::a('<i class="fa fa-check"></i> Valid', ['validate', 'id' => $model->Id], [
					'class' => 'btn btn-success',
					'data' => [
						'confirm' => 'Yakin pembayaran sudah diterima?',
						'method' => 'post',
					],
				]) ?>
			<?= Html::a('<i class="fa fa-warning"></i> Not Valid', ['invalidate', 'id' => $model->Id], ['class' => 'btn btn-warning']) ?>
			
			<span class='pull-right'>
				<?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
				<?= Html::a('Delete', ['delete', 'id' => $model->Id], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
			</span>
			
		</div>
	</div>
		

</div>
