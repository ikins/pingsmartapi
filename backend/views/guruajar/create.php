<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GuruAjar */

$this->title = 'Create Guru Ajar';
$this->params['breadcrumbs'][] = ['label' => 'Guru Ajars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guru-ajar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
