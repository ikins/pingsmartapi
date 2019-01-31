<?php

use yii\helpers\Html;
$this->title = 'Update Wali: ' . $model->Nama;
$this->params['breadcrumbs'][] = ['label' => 'Walis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wali-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
