<?php

use yii\helpers\Html;

$this->title = 'Input Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-create">
	<?= $this->render('_form', [
        'model' => $model,
		'data' => $data,
		'user' => $user,
    ]) ?>

</div>
