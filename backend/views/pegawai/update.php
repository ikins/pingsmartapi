<?php

use yii\helpers\Html;
$this->title = 'Update : ' . $model->biodata->Nama;
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pegawai-update">

    <?= $this->render('_form_update', [
        'model' => $model,
		'data' => $data,
		'user' => $user,
    ]) ?>

</div>
