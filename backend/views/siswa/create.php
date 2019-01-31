<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

$this->title = 'Input Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-create">

    <?= $this->render('_form', [
        'model' => $model,
		'data' => $data,
		'member' => $member,
		'user' => $user,
    ]) ?>

</div>
