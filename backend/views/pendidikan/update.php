<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pendidikan */

$this->title = 'Update Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pendidikan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
