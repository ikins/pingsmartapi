<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KelasGrade */

$this->title = 'Update Kelas Grade: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Kelas Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kelas-grade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
