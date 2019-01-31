<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pendidikan */

$this->title = 'Input Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
