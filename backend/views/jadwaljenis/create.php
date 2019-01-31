<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JadwalJenis */

$this->title = 'Create Jadwal Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
