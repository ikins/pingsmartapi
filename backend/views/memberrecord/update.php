<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemberRecord */

$this->title = 'Update Member Record: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Member Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
