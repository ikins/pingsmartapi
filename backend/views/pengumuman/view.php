<?php

use yii\helpers\Html;
use common\models\MemberLevel;
use common\models\Kelas;

$this->title = 'Detail Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengumuman-view">

	<div class='box box-default'>
		<div class='box-header with-border'>
			 <h1><?= $model->Judul ?></h1>
		</div>
		<div class='box-body'>
			
			<div class='row'>
				<div class='col-sm-8'>
					<?= $model->Pengumuman;?>
					<p>
					<label>Target Audiens</label><br/>
					<?php
						$str='';
							$target=json_decode($model->Target);
							if (count($target) > 0){
								$level=MemberLevel::find()->where(['in','Id',$target])->all();
								foreach($level as $l){$str=$str.$l->Level.', ';}
							
							}
							echo $str;
					?>
					</p>
					<p>
					<label>Target Kelas</label><br/>
					<?php
						$str='';
							$kelas=json_decode($model->KodeKelas);
							if (count($kelas) > 0){
								$kls=Kelas::find()->where(['in','Kode',$kelas])->all();
								foreach($kls as $k){$str=$str.$k->Kelas.', ';}
							
							}
							echo $str;
					?>
					</p>
					
					<p>
					<label>Tanggal Publikasi</label><br/>
					<?= Yii::$app->formatter->asDate($model->BeginPublish).' - '.Yii::$app->formatter->asDate($model->EndPublish);?>
					</p>
				</div>
				<div class='col-sm-4'>
					
				</div>
			</div>
		</div>
		<div class='box-footer'>
			<?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
			<?= Html::a('Delete', ['delete', 'id' => $model->Id], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Are you sure you want to delete this item?',
					'method' => 'post',
				],
			]) ?>
		</div>
	</div>

</div>
