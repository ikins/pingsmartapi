<?php

use yii\helpers\Html;

$this->title = 'Catat Pelanggaran';
$this->params['breadcrumbs'][] = ['label' => 'Pelanggaran Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-record-create">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
