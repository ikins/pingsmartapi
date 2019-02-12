<?php
use yii\helpers\Html;
$this->title = 'pingSmart';

?>
<div class="site-index">
	<section class='intro bg-green white clearfix'>
		<div class='container'>
			<div class='row'>
				<div class='col-sm-4'>
					
					<span class='section-heading'>Selamat Datang di pingSmart</span>
					<h1 class='section-bold'>Platform Sekolah Pintar</h1>
					<p>Untuk system sekolah masa depan yang lebih baik:</p>
					<p>
						<i class='fa fa-check'></i> Penyampaian Informasi sekolah yang efektif<br/>
						<i class='fa fa-check'></i> Komunikasi guru, orang tua dan siswa yang interaktif<br/>
						<i class='fa fa-check'></i> Fasilitas Media belajar yang lebih optimal</br>
					</p>
					
					<?= Yii::$app->algo->renderSplit(50);?>
					<?= Html::a('Login',['/site/login'],['class' => 'btn btn-lg btn-white btn-custom']);?>
					
				</div>
				<div class='col-sm-8'>
					<?= Html::img(Yii::$app->request->baseUrl.'/frontend/images/resources/pingsmart.png',['class' => 'img img-responsive']);?>
				</div>
			</div>
		</div>
	</section>
	<section class='front-bar'>
	</section>
</div>
