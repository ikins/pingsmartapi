<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProgramStudi */

$this->title = 'Input Program Studi';
$this->params['breadcrumbs'][] = ['label' => 'Program Studi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-studi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
