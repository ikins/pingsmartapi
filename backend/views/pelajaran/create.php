<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pelajaran */

$this->title = 'Input Pelajaran';
$this->params['breadcrumbs'][] = ['label' => 'Pelajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajaran-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
