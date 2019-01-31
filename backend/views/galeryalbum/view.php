<?php

use yii\helpers\Html;
$this->title = $model->Album;
$this->params['breadcrumbs'][] = ['label' => 'Galery Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galery-album-view">

    <div class='row'>
		<div class='col-sm-6'>
			<div class='box box-default'>
				<div class='box-header with-border'>
					<h1>
						<?= Html::encode($this->title);?>
					</h1>
				</div>
				<div class='box-body'>
					<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/cover/'.$model->Cover,['class' => 'img img-responsive']);?>
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
