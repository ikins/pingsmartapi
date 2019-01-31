<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NilaiDetail */

$this->title = 'Create Nilai Detail';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
