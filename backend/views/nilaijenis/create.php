<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NilaiJenis */

$this->title = 'Create Nilai Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
