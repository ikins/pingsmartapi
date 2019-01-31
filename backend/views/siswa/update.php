<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

$this->title = 'Update Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siswa-update">

   <?= $this->render('_form_update', [
        'model' => $model,
		'data' => $data,
		'member' => $member,
		'user' => $user,
    ]) ?>

</div>
