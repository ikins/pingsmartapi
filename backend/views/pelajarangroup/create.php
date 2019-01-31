<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PelajaranGroup */

$this->title = 'Create Pelajaran Group';
$this->params['breadcrumbs'][] = ['label' => 'Pelajaran Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajaran-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
