<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MemberLevel;
use common\models\Kelas;
use common\models\SiswaBiodata;
use yii\helpers\Url;

$this->title = 'Tampilkan Agenda';
$this->params['breadcrumbs'][] = ['label' => 'Agenda', 'url' => ['/siswa/agenda']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='member-index'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuSiswa');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'>
					<?= $model->Judul;?>
				</h1>
				<?= $model->Deskripsi;?>
					<p>
					<label>Target Siswa</label><br/>
					<?php
						$str='';
							$target=json_decode($model->NIS);
							if (count($target) > 0){
								$level=SiswaBiodata::find()->where(['in','NIS',$target])->all();
								foreach($level as $l){$str=$str.$l->Nama.', ';}
							
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
					<label>Tanggal</label><br/>
					<?= Yii::$app->formatter->asDate($model->TglAwal).' - '.Yii::$app->formatter->asDate($model->TglAkhir);?>
					</p>

					<p>
					<label>Jam</label><br/>
					<?= ($model->JamAwal).' - '.($model->JamAkhir);?>
					</p>
				
			</div>
		</div>
	</div>
</div>

