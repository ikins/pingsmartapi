<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NilaiJenis */

$this->title = 'Update Nilai Jenis: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nilai-jenis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
