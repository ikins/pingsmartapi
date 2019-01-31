<?php
use yii\helpers\Html;
?>

<div class='box text-center bg-gray-soft'>
	<h3 class='menu-header text-center'>Member Area</h2>
	<div class='row'>
		<div class='col-sm-8 col-sm-offset-2'>
			<p class='text-center'>
				<?= Html::img(Yii::$app->request->baseUrl.'/frontend/images/user/'.Yii::$app->user->identity->member->Avatar,['class' => 'img img-responsive img-circle img-thumbnail']);?>
			</p>
		</div>
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
		<i class="fa fa-sitemap"></i>Data Siswa</br>
		<span class="submenu-link">Data Kelas yang diampu</span>
	</div>
	',['/wali/siswa'])
	?>
	
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-clock-o"></i>Data Tagihan</br>
		<span class="submenu-link">Jadwal Mengajar</span>
	</div>
	',['/guru/pelajaran'])
	?>
	
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-calendar"></i>Kalender Akademik</br>
		<span class="submenu-link">Kalender Kegiatan</span>
	</div>
	',['/guru/pelajaran'])
	?>
	
	<?= Html::a('
	<div class="menu-link">
		<i class="fa fa-bullhorn"></i>Pengumuman</br>
		<span class="submenu-link">Pengumuman</span>
	</div>
	',['/guru/pengumuman'])
	?>
	
	
	
</div>

<div class='box text-center bg-gray-soft'>
	<span class='member-description'>Kode Member: <?= Yii::$app->user->identity->MemberId;?></span>
</div>



