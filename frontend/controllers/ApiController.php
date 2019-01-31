<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\User;
use common\models\Siswa;
use common\models\Jadwal;
use common\models\GaleryAlbum;
use common\models\Galery;
use common\models\Pengumuman;
use common\models\NilaiDetail;
class ApiController extends Controller
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
	
	/*
	***
	FUNGSI KESISWAAN 
	kumpulan fungsi untuk mengambil data siswa
	digunakan oleh ortu saat login
	***/
	
	
	/*
	action untuk memilih data siswa yang akan ditampilkan di dashboard ortu
	apabila anak hanya satu, seetelah login sebaiknya langsung set default
	**/
	
	public function actionShowMyChild(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$query = Siswa::find()->all();
				
				$arrchild=array();
				foreach ($query as $q){
					array_push($arrchild,[
					'Id' => $q->Id,
					'NIS' => $q->NIS,
					'Nama' => $q->biodata->Nama,
					'BirthPlace' => $q->biodata->KotaLahir,
					'Birthday' => $q->biodata->TglLahir,
					'KodeKelas' => $q->KodeKelas,
					'Kelas' => $q->kelas->Kelas,
					'Point' => $q->Point,
					'Billing' => $q->Billing,
					'Keterangan' => 'wow',
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
					'KodeKelas' => $s->KodeKelas,
					'Kelas' => $s->kelas->Kelas,
					'Point' => $s->Point,
					'Billing' => $s->Billing,
					'Lahir' => $s->biodata->KotaLahir,
					'TglLahir' => $s->biodata->TglLahir,
					'Agama' => $s->biodata->agama->Agama,
					'Avatar' => 'frontend/images/user/'.$s->biodata->Foto,
					
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
				
				$query=Galery::find()->where(['IdAlb' => $idalbum,'IsShown' => 1])->all();
				
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
	
	
	
	
}