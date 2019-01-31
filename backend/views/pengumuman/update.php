<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pengumuman */

$this->title = 'Update Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengumuman-update">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
