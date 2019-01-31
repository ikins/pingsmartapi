<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pendidikan */

$this->title = $model->Pendidikan;
$this->params['breadcrumbs'][] = ['label' => 'Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendidikan-view">

    <div class='box box-primary'>
      <div class='box-header with-border'>
        <h1><?= Html::encode($this->title) ?></h1>
      </div>
      <div class='box-body'>

        <div class='row-list'>
          <div class='col-sm-2'>
            ID
          </div>
          <div class='col-sm-9'>
            <?= $model->Id;?>
          </div>
        </div>

        <div class='row-list'>
          <div class='col-sm-2'>
            Kode
          </div>
          <div class='col-sm-9'>
            <?= $model->Kode;?>
          </div>
        </div>

        <div class='row-list'>
          <div class='col-sm-2'>
            Pendidikan
          </div>
          <div class='col-sm-9'>
            <?= $model->Pendidikan;?>
          </div>
        </div>

      </div>
      <div class='box-footer'>
        <?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-warning']) ?>
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
