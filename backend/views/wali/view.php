<?php

use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = $model->Nama;
$this->params['breadcrumbs'][] = ['label' => 'Wali', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wali-view">
	
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h1>
				<?= Html::encode($this->title);?>
			</h1>
		</div>
		<div class='box-body'>
			 <div class='row'>
				<div class='col-sm-6'>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Nama
						</div>
						<div class='col-sm-9'>
							<?= strtoupper($model->Nama);?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Alamat
						</div>
						<div class='col-sm-9'>
							<?= $model->Alamat.' '.$model->Kota.' '.$model->kabupaten->Kabupaten;?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Provinsi
						</div>
						<div class='col-sm-9'>
							<?= $model->provinsi->Provinsi;?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Telepon
						</div>
						<div class='col-sm-9'>
							<?= $model->Telepon;?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Pekerjaan
						</div>
						<div class='col-sm-9'>
							<?= $model->pekerjaan->Pekerjaan;?>
						</div>
					</div>
					<hr/>
					<h4>Siswa</h4>
					
					<?php foreach($siswa as $s):?>
						<?= Html::a($s->siswa->biodata->Nama,['/siswa/view','id' => $s->siswa->Id]);?>
					<?php endforeach;?>
				</div>
				<?php if($model->MemberId != ''):?>
				<div class='col-sm-6'>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kode Member
						</div>
						<div class='col-sm-9'>
							<?= $model->MemberId;?>
						</div>
					</div>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Username
						</div>
						<div class='col-sm-9'>
							<?= $model->member->user->Username;?>
						</div>
					</div>
				</div>
				<?php endif;?>
			 </div>
		</div>
		<div class='box-footer'>
			<?php if($model->MemberId == ''):?>
				<?= Html::a('Daftarkan Member', ['register', 'id' => $model->Id], ['class' => 'btn btn-success']) ?>
			<?php endif;?>
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
