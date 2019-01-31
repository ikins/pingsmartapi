<?php
use yii\helpers\Html;
$this->title='Kelas Yang Diampu';
?>
<div class='container'>
	<div class='row'>
		<div class='col-sm-3'>
			<?= $this->render('/member/_menuGuru');?>
		</div>
		<div class='col-sm-9'>
			<h1 class='page-header'><?= $this->title;?></h1>
			<?php foreach($kelas as $k):?>
				<?= Html::a('
				<div class="menu-link">
					Kelas '.$k->kelas->Kelas.'<br/>
					<span class="submenu-link">'.$k->kelas->Jumlah.' Siswa</span>
				</div>',
				['/guru/siswa/'.$k->kelas->Id])
				?>
			<?php endforeach;?>
		</div>
	</div>
</div>