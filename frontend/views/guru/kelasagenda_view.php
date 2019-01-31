<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\SiswaBiodata;
use common\models\Kelas;
use yii\helpers\Url;

$this->title = 'Tampilkan Agenda Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Agenda Kelas', 'url' => ['/guru/agenda']];
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
				<?= $model->Deskripsi;?>
				
				<p>
				<label>Target Kelas</label><br/>
				<?php
					$str='';
						$kelas=json_decode($model->KodeKelas);
						if (count($kelas) > 0){
							$kls=Kelas::find()->where(['in','Kode',$kelas])->all();
							foreach($kls as $k){$str=$str.$k->Kelas.'<br/>';}
						
						}
						echo $str;
				?>
				</p>
				
				<p>
				<label>Target Siswa</label><br/>
				<?php
					$str='';
						$siswas=json_decode($model->NIS);
						if (count($siswas) > 0){
							$siswa=SiswaBiodata::find()->where(['in','NIS',$siswas])->all();
							foreach($siswa as $s){$str=$str.$s->Nama.'<br/>';}
						
						}
						echo $str;
				?>
				</p>
					
					
				<p>
				<label>Tanggal Kegiatan</label><br/>
				<?= Yii::$app->formatter->asDate($model->TglAwal).' '.Yii::$app->formatter->asTime($model->JamAwal).' s.d. '.Yii::$app->formatter->asDate($model->TglAkhir).' '.Yii::$app->formatter->asTime($model->JamAkhir);?>
				</p>
				<p>
				<label>Keterangan</label>
				<?= $model->Keterangan;?>
				</p>
				
			</div>
		</div>
	</div>
</div>

