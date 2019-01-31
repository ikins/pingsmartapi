<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JadwalJenis */

$this->title = 'Update Jadwal Jenis: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-jenis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
