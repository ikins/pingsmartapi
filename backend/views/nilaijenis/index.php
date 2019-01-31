<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NilaiJenisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nilai Jenis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-jenis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nilai Jenis', ['create'], ['class' => 'btn btn-success']) ?>
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
