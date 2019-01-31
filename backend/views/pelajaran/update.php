<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pelajaran */

$this->title = 'Update Pelajaran';
$this->params['breadcrumbs'][] = ['label' => 'Pelajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pelajaran-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
