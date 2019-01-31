<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaRecord */

$this->title = 'Update Data';
$this->params['breadcrumbs'][] = ['label' => 'Pelanggaran SIswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siswa-record-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
