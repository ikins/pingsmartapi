<?php

use yii\helpers\Html;
$this->title = 'Create Galery Album';
$this->params['breadcrumbs'][] = ['label' => 'Galery Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galery-album-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
