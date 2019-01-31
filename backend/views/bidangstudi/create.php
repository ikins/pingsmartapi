<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BidangStudi */

$this->title = 'Create Bidang Studi';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Studis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-studi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
