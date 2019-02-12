<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Siswas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Siswa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'NIS',
            'NISN',
            'KodeKelas',
            'MemberId',
            // 'ThnMasuk',
            // 'Point',
            // 'Billing',
            // 'Rangking',
            // 'BestScore',
            // 'BestItem',
            // 'Sakit',
            // 'Izin',
            // 'Alpa',
            // 'IsActive',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
