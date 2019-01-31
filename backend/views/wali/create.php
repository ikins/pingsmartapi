<?php

use yii\helpers\Html;
$this->title = 'Input Wali Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Walis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wali-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
