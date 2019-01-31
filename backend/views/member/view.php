<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;


$this->title = $model->Nama;
$this->params['breadcrumbs'][] = ['label' => 'Member', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-view">
	
	<div class='box box-widget'>
		<div class='box-header with-border'>
			<h1><?= $model->Nama ?></h1>
		</div>
		<div class='box-body'>
			
			<div class='row'>
				<div class='col-sm-3'>
					<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$model->Avatar,['class' => 'img-responsive img-thumbnail']);?>
				</div>
				<div class='col-sm-9'>
					<h4 class='noup'>Personal Information</h4>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kode Member
						</div>
						<div class='col-sm-9'>
							<?= $model->MemberId;?>
						</div>
					</div>
								
										
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Nama
						</div>
						<div class='col-sm-9'>
							<?= $model->Nama;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Level
						</div>
						<div class='col-sm-9'>
							<?= $model->level->Level;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Status
						</div>
						<div class='col-sm-9'>
							<?= $model->status->Status;?>
						</div>
					</div>
					
					<?php if (User::find()->where(['MemberId' => $model->MemberId])->one() !== null):?>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Register Date
						</div>
						<div class='col-sm-9'>
							<?= Yii::$app->formatter->asDate($model->user->Created);?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Email
						</div>
						<div class='col-sm-9'>
							<?= $model->user->Email;?>
						</div>
					</div>
					<?php endif;?>
					<?php if ($model->KodePlan !== ''):?>
						
						<h4>Subscription</h4>
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Expired Date
							</div>
							<div class='col-sm-9'>
								<?= Yii::$app->algo->tglIndoNoTime($model->ExpiredDate);?>
							</div>
						</div>
					
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Subscription Plan
							</div>
							<div class='col-sm-9'>
								<?= $model->plan->Plan;?>
							</div>
						</div>
						
						<div class='row rowlist'>
							<div class='col-sm-3'>
								Sisa Masa Aktif
							</div>
							<div class='col-sm-9'>
								<?= $model->RemainPeriode.' hari';?>
							</div>
						</div>
						
					<?php endif;?>
					
				</div>
			</div>
					
			
		</div>
		<div class='box-footer'>
			<?= Html::a('<i class="fa fa-spinner"></i> Aktifkan Paket', ['plan-activate', 'id' => $model->Id], ['class' => 'btn btn-success']) ?>
			<?= Html::a('<i class="fa fa-pencil"></i> Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-info']) ?>
			<?php if($model->IdStat == 6):?>
				<?= Html::a('<i class="fa fa-check"></i> Buka Blokir', ['unblock', 'id' => $model->Id], ['class' => 'btn btn-warning']) ?>
			<?php endif;?>
				
			<span class='pull-right'>
				<?php if($model->IdStat !== 6):?>
					<?= Html::a('<i class="fa fa-ban"></i> Blokir', ['block', 'id' => $model->Id], [
						'class' => 'btn btn-warning',
						'data' => [
							'confirm' => 'Blokir Member?',
							'method' => 'post',
						],
					]) ?>
				<?php else:?>
				
				<?php endif;?>
				
				<?= Html::a('<i class="fa fa-trash"></i> Delete', ['delete', 'id' => $model->Id], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
			</span>
		</div>
	</div>

   

</div>
