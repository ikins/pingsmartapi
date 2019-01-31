<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProgramStudi */

$this->title = $model->ProgramStudi;
$this->params['breadcrumbs'][] = ['label' => 'Program Studi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-studi-view">

    <div class='box box-primary'>
      <div class='box-header with-border'>
        <h1><?= Html::encode($this->title) ?></h1>
      </div>
      <div class='box-body'>

        <div class='row rowlist'>
          <div class='col-sm-2'>
            ID
          </div>
          <div class='col-sm-9'>
            <?= $model->Id;?>
          </div>
        </div>

        <div class='row rowlist'>
          <div class='col-sm-2'>
            Program Studi
          </div>
          <div class='col-sm-9'>
            <?= $model->ProgramStudi;?>
          </div>
        </div>

        <div class='row rowlist'>
          <div class='col-sm-2'>
            Bidang
          </div>
          <div class='col-sm-9'>
            <?= $model->bidang->Bidang;?>
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
