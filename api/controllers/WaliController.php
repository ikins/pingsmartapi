<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;

use common\models\User;
use common\models\Siswa;
use common\models\SiswaWali;
use common\models\Jadwal;
use common\models\NilaiDetail;
use common\models\GaleryAlbum;
use common\models\Galery;
use common\models\Pengumuman;
use common\models\Plan;
class WaliController extends Controller
{
    
    public function actions()
    {
	   Yii::$app->controller->enableCsrfValidation = false;
	   return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
	public function actionIndex()
    {
       return "Invalid Request";
	}
	
	/* 
	fungsi authentifikasi untuk login dan mengambil token
	token disimpan sebagai authkey untuk tahap berikutnya
	*/
	
	public function actionAuth()
    {
      
		if (isset($_POST['uagent'])){
			$username=base64_decode($_POST['username']);
			$password=base64_decode($_POST['password']);
							
			$model=User::findByUsername($username);
			
			//if($model->PasswordResetToken == null){$model->generatePasswordResetToken();}
			
			if(Yii::$app->security->validatePassword($password, $model->Password) == 1){
												
				$arrid=array();
				array_push($arrid,[
					'Id' => $model->member->Id,
					'Nama' => $model->member->Nama,
					'MemberId' => $model->MemberId,
					'Priviledges' => $model->priviledges->Priviledges,
					'PrivId' => $model->IdPriv,
					'Avatar' => $model->member->Avatar,
					'Email' => $model->Email,
					'IdLev' => $model->member->IdLev,
					'Level' => $model->member->level->Level,
					'IsVerified' => $model->IsVerified,
					'IdStat' => $model->member->IdStat,
					'IdStat' => $model->member->status->Status,
					'ActivationDate' =>Yii::$app->formatter->asDate($model->member->ActivationDate),
					'ExpirationDate' =>Yii::$app->formatter->asDate($model->member->ExpiredDate),
					'RemainPeriode' => $model->member->RemainPeriode,
					'Paket' => $model->member->KodePlan=' '?'':$model->member->plan->Plan,
					'Token' => $model->AuthKey,
					
				]);
				
				$model->setLoggedIn();
				return \yii\helpers\Json::encode($arrid);
			
			}
			else{
				echo "Username / Password Salah";
			}
		}
		else{
			return "Invalid Authentication Request";
		}
		
    }
	
	/** 
	cek status
	**/
	public function actionCheckStatus(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$arrchild=array();
				array_push($arrchild,[
					
					'Id' => $model->Id,
					'MemberId' => $model->MemberId,
					'IdStat' => $model->member->IdStat,
					'Status' => $model->member->status->Status,
				]);
				
				
				return \yii\helpers\Json::encode($arrchild);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	/*
	action untuk memilih data siswa yang akan ditampilkan di dashboard ortu
	apabila anak hanya satu, setelah login sebaiknya langsung set default
	**/
	
	public function actionShowMyChild(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$query = SiswaWali::find()->where(['KodeWali' => $model->member->wali->Kode])->all();
				
				$arrchild=array();
				foreach ($query as $q){
					array_push($arrchild,[
					'Id' => $q->Id,
					'NIS' => $q->NIS,
					'Nama' => $q->siswa->biodata->Nama,
					'BirthPlace' => $q->siswa->biodata->KotaLahir,
					'Birthday' => $q->siswa->biodata->TglLahir,
					'KodeKelas' => $q->siswa->KodeKelas,
					'Kelas' => $q->siswa->kelas->Kelas,
					'Point' => $q->siswa->Point,
					'Billing' => $q->siswa->Billing,
					'BestScore' => $q->siswa->BestScore,
					'PresentStudi' =>'Biologi',
					'Sakit' => $q->siswa->Sakit,
					'Izin' => $q->siswa->Izin,
					'Alpa' => $q->siswa->Alpa,
					'Masuk' => '07:00',
					'Ranking' =>'',
					
					]);
				}
				return \yii\helpers\Json::encode($arrchild);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaProfile(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				
				$arrsiswa=array();
				array_push($arrsiswa,[
					'Id' => $s->Id,
					'Nama' => $s->biodata->Nama,
					'Alamat' =>$s->biodata->Alamat,
					'Email' => $s->member->user->Email,
					'KodeKelas' => $s->KodeKelas,
					'Kelas' => $s->kelas->Kelas,
					'Point' => $s->Point,
					'Billing' => $s->Billing,
					'Lahir' => $s->biodata->KotaLahir,
					'TglLahir' => $s->biodata->TglLahir,
					'Agama' => $s->biodata->agama->Agama,
					'Avatar' => 'frontend/images/user/'.$s->biodata->Foto,
					'BestScore' => $s->BestScore,
					'PresentStudi' =>'Biologi',
					'Sakit' => $s->Sakit,
					'Izin' => $s->Izin,
					'Alpa' => $s->Alpa,
					'Masuk' => '07:00',
					'Ranking' => '',
					]);
				
				
				return \yii\helpers\Json::encode($arrsiswa);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaJadwal(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Jadwal::find()->where(['KodeKelas' => $s->KodeKelas])->all();
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Hari' => $q->hari->Hari,
					'JamMulai' => substr($q->JamMulai,0,5),
					'JamAkhir' => substr($q->JamAkhir,0,5),
					'Kode' => $q->KodePel,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					'Guru' => $q->IdGuru =='' ?'':$q->guru->GelarDepan.' '.$q->guru->Nama.' '.$q->guru->GelarBelakang,
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaBilling(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				return '[
				  {
					"Id": 1,
					"Deskripsi": "Tagihan Bulan Maret",
					"Jumlah": "400000",
					"JatuhTempo": "2017-04-01",
					"Status": "Lunas",
					"Keterangan": ""
				  },
				  {
					"Id": 2,
					"Deskripsi": "Tagihan Bulan April",
					"Jumlah": "400000",
					"JatuhTempo": "2017-05-01",
					"Status": "Belum Dibayar",
					"Keterangan": ""
				  },
				  {
					"Id": 3,
					"Deskripsi": "Tagihan Bulan Mei",
					"Jumlah": "400000",
					"JatuhTempo": "2017-06-01",
					"Status": "Belum Dibayar",
					"Keterangan": ""
				  }
				]';

				
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Jadwal::find()->where(['KodeKelas' => $s->KodeKelas])->all();
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Hari' => $q->hari->Hari,
					'JamMulai' => substr($q->JamMulai,0,5),
					'JamAkhir' => substr($q->JamAkhir,0,5),
					'Kode' => $q->KodePel,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					'Guru' => $q->IdGuru =='' ?'':$q->guru->GelarDepan.' '.$q->guru->Nama.' '.$q->guru->GelarBelakang,
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaKuitansi(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$faktur=$_POST['faktur'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				return '[
				  {
					"Id": 1,
					"NIS":1234,
					"Tanggal":"2017-04-01",
					"Faktur":"2222",
					"Deskripsi": "Pembayaran SPP Bulan Maret 2017",
					"Jumlah": "400000",
					"Status": "Lunas",
					"Keterangan": ""
				  },
				  
				]';

				
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaNilaiUlangan(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
												
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=NilaiDetail::find()->where(['NIS' => $s->NIS])->all();
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Tanggal' => $q->parent->Tanggal,
					'KodePel' => $q->KodePel,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					'Nilai' => $q->Nilai,
					'Minimal' => $q->Standar,
					'Status' => $q->status->Status,
					'Keterangan' => $q->Keterangan,
					'Penilai' => $q->parent->guru->biodata->Nama,
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaNilaiRaport(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
												
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=NilaiDetail::find()->where(['NIS' => $s->NIS])->all();
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Tanggal' => $q->parent->Tanggal,
					'KodePel' => $q->KodePel,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					'Nilai' => $q->Nilai,
					'Minimal' => $q->Standar,
					'Status' => $q->status->Status,
					'Keterangan' => $q->Keterangan,
					'Penilai' => $q->parent->guru->biodata->Nama,
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaAlbum(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=GaleryAlbum::find()->/*where(['NIS' => $s->NIS])->*/all();
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Album' => $q->Album,
					'Cover' => 'frontend/images/galery/cover'.$q->Cover,
					'Created' => '2017-05-01',
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaGalery(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$idalbum=$_POST['idalbum'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$query=Galery::find()->where(['IdAlb' => $idalbum,'IdStat' => 2])->all();
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Judul' => $q->Judul,
					'Image' => 'frontend/images/galery/'.$q->Image,
					'Deskripsi' => $q->Deskripsi,
					'Album' => $q->album->Album,
					'Created' => $q->UploadTime,
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaGaleryLatest(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$idalbum=$_POST['idalbum'];
			$model=User::findByAuthKey($token);
						
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Galery::find()->where(['MemberId' => $s->MemberId])->all();
						
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Judul' => $q->Judul,
					'Image' => 'frontend/images/galery/'.$q->Image,
					'Deskripsi' => $q->Deskripsi,
					'Album' => $q->album->Album,
					'Created' => $q->UploadTime,
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaGaleryTop(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$idalbum=$_POST['idalbum'];
			$model=User::findByAuthKey($token);
						
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Galery::find()->where(['MemberId' => $s->MemberId])->all();
						
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Judul' => $q->Judul,
					'Image' => 'frontend/images/galery/'.$q->Image,
					'Deskripsi' => $q->Deskripsi,
					'Album' => $q->album->Album,
					'Created' => $q->UploadTime,
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaGaleryBlocked(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$idalbum=$_POST['idalbum'];
			$model=User::findByAuthKey($token);
						
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Galery::find()->where(['MemberId' => $s->MemberId,'IdStat' => 4])->all();
						
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Judul' => $q->Judul,
					'Image' => 'frontend/images/galery/'.$q->Image,
					'Deskripsi' => $q->Deskripsi,
					'Album' => $q->album->Album,
					'Created' => $q->UploadTime,
					'Remarks' => $q->Remarks,
					]);
				}
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	
	public function actionSiswaGaleryView(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$id=$_POST['idgal'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$q=Galery::find()->where(['Id' => $id])->one();
				
				$arrObject=array();
				
				array_push($arrObject,[
				'Id' => $q->Id,
				'Judul' => $q->Judul,
				'Image' => 'frontend/images/galery/'.$q->Image,
				'Deskripsi' => $q->Deskripsi,
				'Album' => $q->album->Album,
				'Created' => $q->UploadTime,
				]);
								
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionSiswaGaleryBlock(){
		
		if (isset($_POST['token'])){
			
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$id=$_POST['idgal'];
			$remarks=$_POST['reason'];
			
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$q=Galery::find()->where(['Id' => $id])->one();
				
				$q->IdStat=4;
				$q->ModID=$model->MemberId;
				$q->Remarks=$remarks;
							
				
				if($q->save(false)){
					
					return '[{"status":"1","action":"Blokir","keterangan":"Item Berhasil Di Blokir"}]';
					
				}
				else{
					return '[{"status":"0","action":"Blokir","keterangan":"Pemblokiran gagal"}]';
				}
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionPengumuman(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Pengumuman::find()->where(['IdStat' => 2])->andFilterWhere(['LIKE','KodeKelas',$s->KodeKelas])->all();
				
				$arrObject=array();
				array_push($arrObject,$query);
												
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionPengumumanView(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$query=Pengumuman::find()->where(['IdStat' => 2,'Id' => $_POST['id']])->all();
				
				$arrObject=array();
				array_push($arrObject,$query);
												
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	
	public function actionShowPaket(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$p = Plan::find()->all();
				
				$arrObject=array();
				array_push($arrObject,$p);
												
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
		
	}
	
	public function actionBuyPaket(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$kode=$_POST['kode'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$p = Plan::find()->where(['Kode' => $kode])->one();
				
				$arrObject=array();
				array_push($arrObject,[
					'TrxId' => '1234',
					'Kode' => $p->Kode,
					'Paket' => $p->Plan,
					'Durasi' => $p->Durasi,
					'Harga' => $p->Harga,
					
					]);
												
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
		
	}
	
	
	public function actionPaymentConfirm(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$kode=$_POST['invno'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$p = Plan::find()->where(['Kode' => $kode])->one();
				
				$arrObject=array();
				array_push($arrObject,[
					'TrxId' => '1234',
					'KodePembayaran' => 'PAY1234',
					'Jumalh' => '50000',
					'IdStat' => '1',
					'Status' => 'Pending',
					
					]);
												
				return \yii\helpers\Json::encode($arrObject);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
		
	}
	
	public function actionSiswaAgenda(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				return '[
				  {
					"Id": 1,
					"Tanggal":"2017-04-01",
					"JamMulai":"08:00",
					"JamAkhir":"10:00",
					"Agenda": "Latihan Pramuka",
					"Kategori": "Ekskul",
					"Tempat": "Aula Sekolah",
					"Keterangan": ""
				  },
				  
				]';

			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			

	}
	
	public function actionSiswaPelanggaran(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$nis=$_POST['nis'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				return '[
				  {
					"Id": 1,
					"Tanggal":"2017-04-01",
					"Pelanggaran":"Merokok dan Gak bagi2",
					"Kategori":"Berat",
					"Punishment": "10",
					"Keterangan": ""
				  },
				   {
					"Id": 1,
					"Tanggal":"2017-054-01",
					"Pelanggaran":"Tawuran",
					"Kategori":"Berat",
					"Punishment": "25",
					"Keterangan": ""
				  }
				  
				]';

			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			

	}
	
	
}
