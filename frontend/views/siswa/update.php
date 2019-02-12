<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

$this->title = 'Update Siswa: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
