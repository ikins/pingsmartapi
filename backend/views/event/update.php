<?php

use yii\helpers\Html;

$this->title = 'Update Event';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
