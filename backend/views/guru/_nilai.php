<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\NilaiDetailSearch;
use common\models\Nilai;
use common\models\NilaiSearch;

$searchModel = new NilaiSearch(['IdPeg' => $model->IdPeg]);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);


?>


				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'label' => 'Kode',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->Kode;
						},
					],
					[
						'label' => 'Tanggal',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return Yii::$app->formatter->asDate($model->Tanggal);
						},
					],
					[
						'label' => 'Jenis',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->jenis->Jenis;
						},
					],
					[
						'label' => 'Pelajaran',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'value' => function ($model, $key, $index) { 
							return $model->pelajaran->Pelajaran;
						},
					],
					[
						'label' => 'Kelas',
						'attribute' => '',
						'format' => 'raw',
						'vAlign' => 'middle',
						'group' => true,
						'groupedRow'=>true,                    
						'groupOddCssClass'=>'kv-grouped-row',  
						'groupEvenCssClass'=>'kv-grouped-row', 
						'value' => function ($model, $key, $index) { 
							return 'Kelas '.Html::a($model->kelas->Kelas,['/kelas/view','id' => $model->kelas->Id]);
						},
					],
										
					
				],
			]); ?>
				
			</div>
		</div>
	</div>
</div>

