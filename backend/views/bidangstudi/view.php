<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = 'Detail Bidang Studi';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Studi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-studi-view">
	
	<div class='row'>
		<div class='col-sm-4'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					<?= DetailView::widget([
						'model' => $model,
						'attributes' => [
							'Id',
							'Bidang',
						],
					]) ?>
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
