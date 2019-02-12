<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\LinkPager;
use common\models\GaleryAlbum;
$this->title = 'Galeries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galery-index">
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h4>
				<?= Html::encode($this->title) ?>
				<?= Html::a('Upload Galeri', ['/galery/create'], ['class' => 'btn btn-success pull-right']) ?>
			</h4>
		</div>
		<div class='box-body'>
			<div class='row'>
				
				<div class='col-sm-2'>
					<h4><i class="fa fa-folder-open"></i> Album Terbaru</h4>
						<?php
							$albums=GaleryAlbum::Find()->orderBy(['Album' => SORT_ASC])->all();
						    foreach ($albums as $a): ?>
						
								<?= Html::a('<h5 class="nobottom">'.$a->Album.'</h5>',['/siswa/galeriview','id' =>$a->Id],[])?>
								<span class='tb-subrow'><?=$a->member->Nama;?></span>
								<hr/>
						<?php endforeach; ?>
					
				</div>
				<div class='col-sm-8'>
					
					<h4><i class="fa fa-image"></i> Upload Terbaru</h4>
					<div class='row'>
					<?php foreach ($pics as $pic): ?>
						<div class='col-sm-3'>
							<div class='box-round bg-gray-soft'>
								<?= Html::a(Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/thumbnail/'.$pic->Image,['class' => 'img img-responsive']),['/galery/view','id' =>$pic->Id],[])?>
								<div class='inner'>
									<strong><?=$pic->Judul;?></strong>
									<p class='tb-subrow dark'><?=$pic->album->Album;?><span class='pull-right'><?= Yii::$app->formatter->asDateTime($pic->UploadTime);?></span></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			
			
			
			
				
			</div>
			<div class='row'>
				<div class='col-sm-12 text-center'>
				<?= LinkPager::widget(['pagination' => $pagination,]);?>
				</div>
			</div>
			
		</div>
	</div>

</div>
