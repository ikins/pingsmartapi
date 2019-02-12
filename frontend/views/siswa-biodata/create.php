<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SiswaBiodata */

$this->title = 'Create Siswa Biodata';
$this->params['breadcrumbs'][] = ['label' => 'Siswa Biodatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-biodata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
