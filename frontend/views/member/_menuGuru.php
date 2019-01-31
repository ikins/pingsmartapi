<?php
use yii\helpers\Html;
?>

<div class='box text-center bg-gray-soft'>
	<h3 class='menu-header text-center'>Member Area</h2>
	<div class='col-sm-8 col-sm-offset-2'>
		<p class='text-center'>
			<?= Html::img(Yii::$app->request->baseUrl.'/frontend/images/user/'.Yii::$app->user->identity->member->Avatar,['class' => 'img img-responsive img-circle img-thumbnail']);?>
		</p>
	</div>
	<h4><?= Yii::$app->user->identity->member->Nama;?></h4>
	<span class='member-priviledges'><?= Yii::$app->user->identity->priviledges->Priviledges;?></span><br/>
</div>

<div class='box no-padding bg-gray-soft'>
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-desktop"></i>Dashboard</br>
		<span class="submenu-link">My Dashboard</span>
	</div>
	',['/member/index'])
	?>
	
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-sitemap"></i>Data Kelas</br>
		<span class="submenu-link">Data Kelas yang diampu</span>
	</div>
	',['/guru/kelas'])
	?>
	
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-clock-o"></i>Jadwal Mengajar</br>
		<span class="submenu-link">Jadwal Mengajar</span>
	</div>
	',['/guru/pelajaran'])
	?>
		
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-files-o"></i>Daftar Nilai</br>
		<span class="submenu-link">Nilai yang Diberikan</span>
	</div>
	',['/guru/nilai'])
	?>
	
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-warning"></i>Pelanggaran Siswa</br>
		<span class="submenu-link">Pelanggaran Siswa</span>
	</div>
	',['/guru/pelanggaran'])
	?>
	
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-bullhorn"></i>Pengumuman</br>
		<span class="submenu-link">Pengumuman</span>
	</div>
	',['/guru/pengumuman'])
	?>
	
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-calendar"></i>Agenda Kelas</br>
		<span class="submenu-link">Data Agenda yang Dibuat</span>
	</div>
	',['/guru/agenda'])
	?>
	
</div>

<div class='box text-center bg-gray-soft'>
	<span class='member-description'>Kode Pegawai: <?= Yii::$app->user->identity->member->pegawai->IdPeg;?></span>
</div>



