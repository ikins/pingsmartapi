<?php

use yii\helpers\Html;
$this->title = 'Input Pelanggaran';
$this->params['breadcrumbs'][] = ['label' => 'Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggaran-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
