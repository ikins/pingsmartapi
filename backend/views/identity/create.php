<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Identity */

$this->title = 'Create Identity';
$this->params['breadcrumbs'][] = ['label' => 'Identities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
