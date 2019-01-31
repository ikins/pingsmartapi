<?php

use yii\helpers\Html;

$this->title = 'Create Pekerjaan';
$this->params['breadcrumbs'][] = ['label' => 'Pekerjaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerjaan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
