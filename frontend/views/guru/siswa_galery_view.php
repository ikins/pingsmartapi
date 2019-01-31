<?php
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Tampilkan Galeri';
$this->params['breadcrumbs'][] = ['label' => 'Guru', 'url' => ['/member/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='member-index'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<?= $this->render('/member/_menuGuru');?>
			</div>
			<div class='col-sm-9'>
				<h1 class='page-header'><?= $this->title;?></h1>
				<div class='row'>
					<div class='col-sm-8'>
						<?php if($model->IdStat ==4):?>
						<div class="ribbon-top-left">
							<div class="txt">
								BLOKIR
							</div>
						</div>
						<?php endif;?>
						<?php if($model->IdStat ==4):?>
								<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/'.$model->Image,['class' => 'img img-responsive img-gray']);?>
							<?php else:?>
								<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/'.$model->Image,['class' => 'img img-responsive']);?>
							<?php endif;?>
						
					</div>
					<div class='col-sm-4'>
						<h4><?= $model->Judul;?></h4>
						<?=$model->Deskripsi;?>
						<br/>
						<span class='pull-right tb-subrow'>Upload By: <?= Yii::$app->formatter->asDateTime($model->UploadTime);?></span>
						<hr/>
						<div class='row rowlist'>
							<div class='col-sm-12'>
								<label>Upload By</label><br/>
								<?= $model->member->Nama;?>
							</div>
						</div>
						<hr/>
						<div class='row rowlist'>
							<div class='col-sm-12'>
								<label>Album</label><br/>
								<?= $model->album->Album;?>
							</div>
						</div>
						<hr/>
						<?= Html::a('<i class="fa fa-arrow->left"></i> Kembali', ['/guru/siswaview', 'id' => $model->member->siswa->Id], ['class' => 'btn btn-default']) ?>
						<?= Html::a('<i class="fa fa-ban"></i> Blokir', ['/guru/siswa-galery-ban', 'id' => $model->Id], ['class' => 'btn btn-warning']) ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

