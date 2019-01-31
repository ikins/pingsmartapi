<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Plan */

$this->title = 'Buat Paket';
$this->params['breadcrumbs'][] = ['label' => 'Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
