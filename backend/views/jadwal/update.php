<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jadwal */

$this->title = 'Update Jadwal: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
