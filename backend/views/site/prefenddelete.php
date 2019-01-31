<?php
use yii\helpers\Html;
$this->title = 'Proses gagal';
?>
<div class="site-index">
	
    
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <div class='alert alert-warning'>
					
					<h4>Proses Ditolak</h4>
					<div class='row'>
						<div class='col-sm-4'>
						</div>
						<div class='col-sm-8'>
							<h5><?= $data;?> tidak dapat dihapus Karena masih digunakan/terhubung dengan data lainnya.</h5>
							<p>
								Bila Anda menemukan pesan seperti ini, berarti data terkait sedang digunakan atau terhubung ke data lain. Menghapus data tersebut akan mengakibatkan kesalahan system.
							</p>
							<p>
								 Untuk dapat menghapus <?= $data;?> terkait, Anda terlebih dahulu harus menghapus data /sub kategori nya.
							</p>
							
						</div>
					</div>
					
				</div>
				<?= Html::a('Kembali Ke Halaman Sebelumnya', Yii::$app->request->referrer,['class' => 'btn btn-default']);?>
            </div>
        </div>
	</div>

    
</div>
