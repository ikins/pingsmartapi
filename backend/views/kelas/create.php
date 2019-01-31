<?php

use yii\helpers\Html;
$this->title = 'Input Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-create">
 <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
