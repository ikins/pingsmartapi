<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JadwalJenisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal Jenis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-jenis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jadwal Jenis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Jenis',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
