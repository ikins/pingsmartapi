<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MemberLevel;
use common\models\Kelas;
use yii\helpers\Url;

$this->title = 'Tampilkan Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Pengumuman', 'url' => ['/guru/pengumuman']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='member-index'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuGuru');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'>
					<?= $model->Judul;?>
				</h1>
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
		</div>
	</div>
</div>

