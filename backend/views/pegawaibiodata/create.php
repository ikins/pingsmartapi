<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PegawaiBiodata */

$this->title = 'Create Pegawai Biodata';
$this->params['breadcrumbs'][] = ['label' => 'Pegawai Biodatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-biodata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
