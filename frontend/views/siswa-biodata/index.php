<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SiswaBiodataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Siswa Biodatas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-biodata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Siswa Biodata', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'NIS',
            'Nama',
            'JK',
            'KotaLahir',
            // 'TglLahir',
            // 'IdAgm',
            // 'idGoldar',
            // 'Alamat',
            // 'Kota',
            // 'Telepon',
            // 'HP',
            // 'IdKab',
            // 'IdProv',
            // 'Pos',
            // 'IdDom',
            // 'AlamatDom',
            // 'KotaDom',
            // 'IdKabDom',
            // 'IdProvDom',
            // 'TeleponDom',
            // 'Foto',
            // 'Keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
