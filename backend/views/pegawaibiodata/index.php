<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PegawaiBiodataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pegawai Biodatas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-biodata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pegawai Biodata', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'IdPeg',
            'Nama',
            'GelarDepan',
            'GelarBelakang',
            // 'Alamat',
            // 'Kota',
            // 'IdProv',
            // 'IdKab',
            // 'KotaLahir',
            // 'TglLahir',
            // 'JK',
            // 'Telepon',
            // 'HP',
            // 'Pos',
            // 'Foto',
            // 'Keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
