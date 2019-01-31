<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KelasAgenda */

$this->title = 'Create Kelas Agenda';
$this->params['breadcrumbs'][] = ['label' => 'Kelas Agendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-agenda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
