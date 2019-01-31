<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
$this->title = $model->Kelas;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-view">

	
	<div class='box box-primary'>
		<div class='box-header with-border'>
			<h1><?= Html::encode($this->title) ?></h1>
		</div>
		<div class='box-body'>
			
			<div class='row'>
				<div class='col-sm-6'>
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kode Kelas
						</div>
						<div class='col-sm-9'>
							<?= $model->Kode;?>
						</div>
					</div>
								
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kelas
						</div>
						<div class='col-sm-9'>
							<?= $model->Kelas;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Jenis
						</div>
						<div class='col-sm-9'>
							<?= $model->grade->Grade;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Jurusan
						</div>
						<div class='col-sm-9'>
							<?= $model->jurusan->Jurusan;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Kompetensi
						</div>
						<div class='col-sm-9'>
							<?php if($model->IdKom > 0):?>
								<?= $model->kompetensi->Kompetensi;?>
							<?php else:?>
								Non Kompetensi
							<?php endif;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Jumlah Siswa
						</div>
						<div class='col-sm-9'>
							<?= $model->Jumlah;?>
						</div>
					</div>
					
					<div class='row rowlist'>
						<div class='col-sm-3'>
							Wali Kelas
						</div>
						<div class='col-sm-9'>
							<?php if($model->IdWk !== ''):?>
								<?= $model->wali->Nama;?>
							<?php else:?>
								-
							<?php endif;?>
							
						</div>
					</div>
				</div>
				<div class='col-sm-3 pull-right text-center'>
					<?php if($model->IdWk !== ''):?>
						<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.$model->wali->Avatar,['class' => 'img-responsive img-thumbnail img-pass']);?><br/>
						<?= $model->wali->Nama;?><br/><i>Wali Kelas <?= $model->Kode;?></i>
					<?php else:?>
						-
					<?php endif;?>
				</div>
			</div>
		
			
			
			
			
			<div class='row'>
				<div class='col-sm-12'>
					<?= Yii::$app->algo->renderSplit(30);?>
					<?= Tabs::widget([
							'items' => [
								[
									'label' => 'Siswa',
									'content' => $this->render('_siswa',['dataProvider' => $dataProvider,'searchModel' => $searchModel]),
									'active' => true
								],
								[
									'label' => 'Jadwal Pelajaran',
									'content' => $this->render('_jadwal',['kodekelas' => $model->Kode]),
								],
								[
									'label' => 'Nilai',
									'content' => $this->render('_nilai',['kodekelas' => $model->Kode]),
								],
								
							],
						]
						);
					?>
				</div>
			</div>	
		</div>
		<div class='box-footer'>
			<?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
			<?= Html::a('Delete', ['delete', 'id' => $model->Id], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Are you sure you want to delete this item?',
					'method' => 'post',
				],
			]) ?>
		</div>
	</div>
    
</div>
