<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NilaiDetail */

$this->title = 'Update Nilai Detail: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nilai-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
