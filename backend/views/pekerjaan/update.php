<?php

use yii\helpers\Html;


$this->title = 'Update Pekerjaan';
$this->params['breadcrumbs'][] = ['label' => 'Pekerjaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pekerjaan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
