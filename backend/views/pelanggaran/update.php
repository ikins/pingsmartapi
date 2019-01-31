<?php

use yii\helpers\Html;

$this->title = 'Update Pelanggaran';
$this->params['breadcrumbs'][] = ['label' => 'Pelanggarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pelanggaran-update">

     <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
