<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Identity */

$this->title = 'Update Identity: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Identities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="identity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
