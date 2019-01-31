<?php

use yii\helpers\Html;
$this->title = 'Update Kelas: ' . $model->Kode;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kelas-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
