<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProgramStudi */

$this->title = 'Update Program Studi';
$this->params['breadcrumbs'][] = ['label' => 'Program Studi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="program-studi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
