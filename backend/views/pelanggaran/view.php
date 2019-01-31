<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title ='Detail';
$this->params['breadcrumbs'][] = ['label' => 'Master Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggaran-view">

   <div class='row'>
		<div class='col-sm-6 col-md-4'>
			<div class='box box-widget'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					 <?= DetailView::widget([
						'model' => $model,
						'attributes' => [
							//'Id',
							'Pelanggaran',
							'kategori.Kategori',
							'Point',
							'Keterangan',
						],
					]) ?>
				</div>
				<div class='box-footer'>
					<p class="pull-right">
						<?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
						<?= Html::a('Delete', ['delete', 'id' => $model->Id], [
							'class' => 'btn btn-danger',
							'data' => [
								'confirm' => 'Are you sure you want to delete this item?',
								'method' => 'post',
							],
						]) ?>
					</p>
				</div>
			</div>
		</div>
	</div>
   
</div>
