<?php

use yii\helpers\Html;
$this->title = 'Input Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengumuman-create">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
