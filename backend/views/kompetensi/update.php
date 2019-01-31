<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kompetensi */

$this->title = 'Update Kompetensi';
$this->params['breadcrumbs'][] = ['label' => 'Kompetensis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kompetensi-update">

   <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
