<?php

use yii\helpers\Html;
$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-update">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
