<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kompetensi */

$this->title = 'Create Kompetensi';
$this->params['breadcrumbs'][] = ['label' => 'Kompetensis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kompetensi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
