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
				<?= Html::a('Upload Galeri', ['create'], ['class' => 'btn btn-success pull-right']) ?>
			</h4>
		</div>
		<div class='box-body'>
			<div class='row'>
				
				<div class='col-sm-2'>
					<h4><i class="fa fa-folder-open"></i> Album Terbaru</h4>
						<?php
							$albums=GaleryAlbum::Find()->all();
						    foreach ($albums as $a): ?>
						
								<?= Html::a('<h5 class="nobottom">'.$a->Album.'</h5>',['/galery/album','id' =>$a->Id],[])?>
								<span class='tb-subrow'><?=$a->member->Nama;?></span>
								<hr/>
						<?php endforeach; ?>
					
				</div>
				<div class='col-sm-8'>
					
					<h4><i class="fa fa-image"></i> Upload Terbaru</h4>
					<div class='row'>
					<?php foreach ($pics as $pic): ?>
						<div class='col-sm-3'>
							<?php if($pic->IdStat ==4):?>
							<div class="ribbon-top-left">
								<div class="txt">
									BLOKIR
								</div>
							</div>
							<?php endif;?>
							
							<div class='box-round bg-gray-soft'>
								<?php if($pic->IdStat ==4):?>
									<?= Html::a(Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/thumbnail/'.$pic->Image,['class' => 'img img-responsive img-gray']),['view','id' =>$pic->Id],[])?>
								<?php else:?>
									<?= Html::a(Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/thumbnail/'.$pic->Image,['class' => 'img img-responsive']),['view','id' =>$pic->Id],[])?>
								<?php endif;?>
								<div class='inner'>
									<p class='text-center italic dark'><?=$pic->Judul;?></p>
									<p><i class='fa fa-folder-open text-info'></i> <?=$pic->album->Album;?>
										<span class='pull-right'>
											<?= Html::a('<i class="fa fa-ban"></i>',['bann','id' => $pic->Id],['class' => 'label label-warning']).'  '.
											Html::a('<i class="fa fa-close"></i>', ['delete', 'id' => $pic->Id], [
											'class' => 'label label-danger',
											'data' => [
												'confirm' => 'Are you sure you want to delete this item?',
												'method' => 'post',
											],
										]) ?>
									</p>
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
