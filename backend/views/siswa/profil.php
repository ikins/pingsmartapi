<?php

use yii\helpers\Html;
$this->title = 'Profil Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">
	
	<div class='box box-warning'>
		<div class='box-header with-border'>
			 <h1>
				<?= Html::encode($this->title) ?>
				<?= Html::a('Input Siswa', ['create'], ['class' => 'btn btn-success pull-right']) ?>
			</h1>
		</div>
		<div class='box-body no-padding'>
			<div class='row'>
			<?php foreach($models as $m):?>
				<div class='img-fix-container'>
					<div class='col-sm-2'>
						<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$m->biodata->Foto,['class' => 'img-responsive img-thumbnail img-pass-fix-height']);?><br/>
					</div>
				</div>
			<?php endforeach;?>
			</div>
		</div>
	</div>
</div>
