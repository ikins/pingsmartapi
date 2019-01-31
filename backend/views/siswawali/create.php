<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SiswaWali */

$this->title = 'Create Siswa Wali';
$this->params['breadcrumbs'][] = ['label' => 'Siswa Walis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-wali-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
