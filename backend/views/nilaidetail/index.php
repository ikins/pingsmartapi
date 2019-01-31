<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NilaiDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nilai Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nilai Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Kode',
            'NIS',
            'KodePel',
            'Nilai',
            // 'Standar',
            // 'IdStat',
            // 'TglInput',
            // 'Keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
