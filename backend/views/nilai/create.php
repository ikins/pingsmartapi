<?php

use yii\helpers\Html;

$this->title = 'Input Nilai';
$this->params['breadcrumbs'][] = ['label' => 'Nilai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
