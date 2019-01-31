
 <?php

use yii\helpers\Html;

$this->title = 'Kalender Akademik';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelatihan-event-calendar">
	
	<div class='row'>
		<div class='col-sm-6'>
			<div class='box box-primary'>
				<div class='box-header with-border'>
					<h4><?=$this->title;?></h4>
				</div>
				<div class='box-body'>
					<?php
						$events = array();
						foreach($agenda as $a){
							
							  $Event = new \yii2fullcalendar\models\Event();
							  $Event->id = $a->Id;
							  $Event->title = $a->Event;
							  $Event->start = $a->Tanggal;
							  $Event->end=$a->TanggalAkhir;
							  $Event->url=['view/'.$a->Id];
							  $Event->color=' #ff6c60';
							  
							$events[] = $Event;
							
						}
						  
					?>	 
					 <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
						  'events'=> $events,
					  ));
					  ?>
				</div>
			</div>
		</div>
		
		<div class='col-sm-4'>
			<div class='box box-primary'>
				<div class='box-header with-border'>
					<h4>Jadwal Kegiatan</h4>
				</div>
				<div class='box-body'>
					<?php foreach($agenda as $a):?>
						
						<?= Html::a('<h5 class="nobottom">'.$a->Event.'</h5>',['view','id' => $a->Id]);?>
						<?= Yii::$app->formatter->asDate($a->Tanggal).' | '.$a->Tempat;?>
						<hr/>
												  
					<?php endforeach?>	 
					<?= Html::a('Buat Jadwal',['/event/create'],['class' => 'btn btn-primary']);?>
				</div>
			</div>
		</div>
	</div>


 </div>