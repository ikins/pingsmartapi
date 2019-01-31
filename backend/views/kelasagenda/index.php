<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KelasAgendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas Agendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-agenda-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kelas Agenda', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Judul',
            'Deskripsi',
            'TglAwal',
            'JamAwal',
            // 'TglAkhir',
            // 'JamAkhir',
            // 'KodeKelas',
            // 'NIS',
            // 'IdStat',
            // 'IdPeg',
            // 'Keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
