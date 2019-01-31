<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Jadwal */

$this->title = $model->KodePel;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-view">

    <div class='box box-primary'>
        <div class='box-header with-border'>
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class='box-body'>
        
            <div class='row rowlist'>
                <div class='col-sm-3'>
                    ID
                </div>
                <div class='col-sm-9'>
                    <?= $model->Id;?>
                </div>
            </div>
                        
            <div class='row rowlist'>
                <div class='col-sm-3'>
                    Kelas
                </div>
                <div class='col-sm-9'>
                    <?= $model->KodeKelas;?>
                </div>
            </div>
            
            <div class='row rowlist'>
                <div class='col-sm-3'>
                    Kode Pelajaran
                </div>
                <div class='col-sm-9'>
                    <?= $model->KodePel;?>
                </div>
            </div>
            
            <div class='row rowlist'>
                <div class='col-sm-3'>
                    Jenis Jadwal
                </div>
                <div class='col-sm-9'>
                    <?= $model->jenis->Jenis;?>
                </div>
            </div>
            
            <div class='row rowlist'>
                <div class='col-sm-3'>
                    Hari 
                </div>
                <div class='col-sm-9'>
                    <?= $model->hari->Hari;?>
                </div>
            </div>
            
            <div class='row rowlist'>
                <div class='col-sm-3'>
                    Jam Mulai
                </div>
                <div class='col-sm-9'>
                    <?= $model->JamMulai;?>
                </div>
            </div>

            <div class='row rowlist'>
                <div class='col-sm-3'>
                    Jam Akhir
                </div>
                <div class='col-sm-9'>
                    <?= $model->JamAkhir;?>
                </div>
            </div>
            
            <div class='row rowlist'>
                <div class='col-sm-3'>
                    ID Guru
                </div>
                <div class='col-sm-9'>
                    <?= $model->IdGuru;?>
                </div>
            </div>

            <div class='row rowlist'>
                <div class='col-sm-3'>
                    Keterangan
                </div>
                <div class='col-sm-9'>
                    <?= $model->Keterangan;?>
                </div>
            </div>
            
        </div>
        <div class='box-footer'>
            <?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->Id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

</div>