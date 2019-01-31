<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KelasGradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas Grades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-grade-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kelas Grade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Grade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
