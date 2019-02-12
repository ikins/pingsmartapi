<?php

use yii\helpers\Html;
$this->title = 'Ganti Password';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?= $this->render('_formpasschange', ['model' => $model,]) ?>
</div>
