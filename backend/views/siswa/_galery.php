<?php
use yii\helpers\Html;

?>
<?= Yii::$app->algo->renderSplit(20);?>
	
<?php foreach ($galeri as $pic): ?>
<div class='col-sm-3 col-md-2'>

	
	<?php if($pic->IdStat ==4):?>
	<div class="ribbon-top-left">
		<div class="txt">
			BLOKIR
		</div>
	</div>
	<?php endif;?>
	
	<div class='box-round bg-gray-soft'>
		<?php if($pic->IdStat ==4):?>
			<?= Html::a(Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/thumbnail/'.$pic->Image,['class' => 'img img-responsive img-gray']),['/galery/view','id' =>$pic->Id],[])?>
		<?php else:?>
			<?= Html::a(Html::img(Yii::$app->params['baseUrl'].'/frontend/images/galery/thumbnail/'.$pic->Image,['class' => 'img img-responsive']),['/galery/view','id' =>$pic->Id],[])?>
		<?php endif;?>
		<div class='inner'>
			<p class='text-center italic dark'><?=$pic->Judul;?></p>
			<p><i class='fa fa-folder-open text-info'></i> <?=$pic->album->Album;?>
				<span class='pull-right'>
					<?= Html::a('<i class="fa fa-ban"></i>',['/galery/bann','id' => $pic->Id],['class' => 'label label-warning']).'  '.
					Html::a('<i class="fa fa-close"></i>', ['/galery/delete', 'id' => $pic->Id], [
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
