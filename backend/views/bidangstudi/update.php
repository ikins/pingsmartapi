<?php

use yii\helpers\Html;

$this->title = 'Update Bidang Studi ';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Studis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-studi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
