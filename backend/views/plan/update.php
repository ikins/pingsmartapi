<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Plan */

$this->title = 'Update Paket';
$this->params['breadcrumbs'][] = ['label' => 'Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plan-update">

     <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
