<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\BankAccount;
use common\models\Plan;
use common\models\User;
use common\models\Siswa;
use common\models\Jadwal;
use common\models\GaleryAlbum;
use common\models\Galery;
use common\models\GuruAjar;
use common\models\Pelajaran;
use common\models\PelajaranGroup;
use common\models\Pengumuman;
use common\models\Nilai;
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

	/* GURU START */
	
	/* 
	fungsi authentifikasi untuk login dan mengambil token
	token disimpan sebagai authkey untuk tahap berikutnya
    
    http://pingsmart.gallerysneakers27.com/api/auth-guru?uagent=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm&user=farida&pass=123456
    
	*/
	
	public function actionAuthGuru($uagent,$user,$pass)
    {
      
		if (isset($uagent)){
			// $username=base64_decode($user);
			// $password=base64_decode($pass);
			$username=$user;
			$password=$pass;	
			
			$model=User::findByUsername($username);
			
			//if($model->PasswordResetToken == null){$model->generatePasswordResetToken();}
			
			if(Yii::$app->security->validatePassword($password, $model->Password) == 1){
						
				$jd=new Jadwal;	
												
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
					'NIP' => $model->member->pegawai->NIP,
					'JamAjar' => $jd->getTeachingHour($model->member->pegawai->IdPeg),
					'KelasSekarang' =>'1A',
					'AjarSekarang' =>$jd->getNowSchedule($model->member->pegawai->IdPeg),
					'KelasBerikut' => $jd->getNextSchedule($model->member->pegawai->IdPeg),
				]);
				
				$model->setLoggedIn();
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrid, ];
				return \yii\helpers\Json::encode($result);
			
			}
			else{
				$result = ['response_code' => 0, 'messages' => 'Username / Password Salah', 'status' => true, 'data' => 'Username / Password Salah'];
				return \yii\helpers\Json::encode($result);
			}
		}
		else{
			return "Invalid Authentication Request";
		}
		
    }
    
    
	/*
	action untuk menampilkan kelas yang diajar oleh guru ybs
	
	http://pingsmart.gallerysneakers27.com/api/show-my-class?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	
	**/
	
	public function actionShowMyClass($token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				//$query=GuruAjar::find()->select('KodeKelas')->where(['IdPeg' => $model->member->pegawai->IdPeg])->distinct()->all();
				$query = GuruAjar::find()->where(['IdPeg' => $model->member->pegawai->IdPeg])->all();
				
				$arrchild=array();
				foreach ($query as $q){
					array_push($arrchild,[
					'Id' => $q->Id,
					'KodeKelas' => $q->KodeKelas,
					'Kelas' => $q->kelas->Kelas,
					'KodePel' => $q->KodePel,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					'Siswa' => $q->kelas->Jumlah,
					'IdPeg' => $q->IdPeg,
					]);
				}
				
				//$group = array();
/*
				foreach ( $arrchild as $value ) {
					$arrchild[$value['KodeKelas']][] = $value;
				}
				*/
				foreach ($arrchild as $data) {
				  $id = $data['KodeKelas'];
				  if (isset($arrid[$id])) {
					 $arrid[$id][] = $data;
				  } else {
					 $arrid[$id] = array($data);
				  }
				}

				//var_dump($group);
				
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrid, ];
				return \yii\helpers\Json::encode($result);
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
	action untuk menampilkan data siswa berdasarkan kode kelas
	
	http://pingsmart.gallerysneakers27.com/api/siswa-by-kelas?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm&kodekls=1 A
	
	**/
	
	public function actionSiswaByKelas($token,$kodekls){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = Siswa::find()->where(['KodeKelas'=>$kodekls])->all();
				$arrchild=array();
				foreach ($query as $q){
					array_push($arrchild,[
					'Id' => $q->Id,
					'NIS' => $q->NIS,
					'Nama' => $q->biodata->Nama,
					'BirthPlace' => $q->biodata->KotaLahir,
					'Birthday' => $q->biodata->TglLahir,
					'Point' => $q->Point,
					'Masuk' => '07:00',
					'Ranking' =>'',
					'Foto' =>$q->biodata->Foto,
					]);
				}
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrchild, ];
				return \yii\helpers\Json::encode($result);
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
	Menampilkan detail profile siswa oleh guru
	
	http://pingsmart.gallerysneakers27.com/api/siswa-profile-by-guru?nis=990002&token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	*/

	public function actionSiswaProfileByGuru($nis, $token){
		
		if (isset($token)){
			// $token=$token;
			// $nis=$nis;
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['Nis'=>$nis])->one();
				
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
				
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrsiswa, ];
				return \yii\helpers\Json::encode($result);
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
	Menampilkan Mata Pelajaran yang diajar
	
	http://pingsmart.gallerysneakers27.com/api/pelajaran-by-guru?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	*/

	public function actionPelajaranByGuru($token){
		
		if (isset($token)){
			// $token=$token;
			// $nis=$nis;
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$query = GuruAjar::find()->where(['IdPeg' => $model->member->pegawai->IdPeg])->groupBy(['KodePel'])->all();
				
				$arrchild=array();
				foreach ($query as $q){
					array_push($arrchild,[
					'Id' => $q->Id,
					'KodePel' => $q->KodePel,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					'IdPeg' => $q->IdPeg,
					]);
				}
				
				foreach ($arrchild as $data) {
				  $id = $data['KodeKelas'];
				  if (isset($arrid[$id])) {
					 $arrid[$id][] = $data;
				  } else {
					 $arrid[$id] = array($data);
				  }
				}
				
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrchild, ];
				return \yii\helpers\Json::encode($result);
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
	Menampilkan Detail Mata Pelajaran yang diajar
	
	http://pingsmart.gallerysneakers27.com/api/pelajaran-detail-by-guru?kodemapel=BINDO&token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	*/

	public function actionPelajaranDetailByGuru($kodemapel,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$query = Pelajaran::find()->where(['Kode' => $kodemapel])->one();
				
				$arrchild=array();
					array_push($arrchild,[
					'Id' => $query->Id,
					'KodePel' => $query->Kode,
					'Pelajaran' => $query->Pelajaran,
					'KodeGroup' => $query->group->Kode,
					'Group' => $query->group->Group,
					]);
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrchild, ];
				return \yii\helpers\Json::encode($result);
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
	Menampilkan Jadwal Mengajar
	
	http://pingsmart.gallerysneakers27.com/api/jadwal-ajar?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	*/

	public function actionJadwalAjar($token){
		
		if (isset($token)){
		    
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$query = Jadwal::find()->where(['IdGuru' => $model->member->pegawai->IdPeg])->all();
				
				$arrchild=array();
				foreach ($query as $q){
					array_push($arrchild,[
					'Id' => $q->Id,
					'KodeKelas' => $q->KodeKelas,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					'Jenis' => $q->jenis->Jenis,
					'Hari' => $q->hari->Hari,
					'IdGuru' => $q->IdGuru,
					]);
				}
				
				foreach ($arrchild as $data) {
				  $id = $data['KodeKelas'];
				  if (isset($arrid[$id])) {
					 $arrid[$id][] = $data;
				  } else {
					 $arrid[$id] = array($data);
				  }
				}
				
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrchild, ];
				return \yii\helpers\Json::encode($result);
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
	Menampilkan Detail Jadwal Mengajar
	
	http://pingsmart.gallerysneakers27.com/api/jadwal-detail-ajar?kodejadwal=8&token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	*/

	public function actionJadwalDetailAjar($kodejadwal,$token){
		
		if (isset($token)){
		    
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$query = Jadwal::find()->where(['IdGuru' => $model->member->pegawai->IdPeg,'Id'=>$kodejadwal])->one();
				
				$arrchild=array();
					array_push($arrchild,[
					'Id' => $query->Id,
					'KodeKelas' => $query->KodeKelas,
					'Pelajaran' => $query->pelajaran->Pelajaran,
					'Jenis' => $query->jenis->Jenis,
					'Hari' => $query->hari->Hari,
					'JamMulai' => $query->JamMulai,
					'JamAkhir' => $query->JamAkhir,
					'IdGuru' => $query->IdGuru,
					]);
				
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrchild, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
    
	/*** list nilai Menampilkan Daftar Nilai berdasarkan Guru 
	
	http://pingsmart.gallerysneakers27.com/api/nilai-by-guru?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	
	***/
	public function actionNilaiByGuru($token){
		
		if (isset($token)){
		    
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = Nilai::find()->where(['IdPeg' => $model->member->pegawai->IdPeg])->all();
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'Kode' => $q->Kode,
					'Tanggal' => $q->Tanggal,
					'IdJenis' => $q->IdJenis,
					'Jenis' => $q->jenis->Jenis,
					'KodeKelas' => $q->KodeKelas,
					'Kelas' => $q->kelas->Kelas,
					'KodePel' => $q->KodePel,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					]);
				}
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrdata, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
    
	/** Menampilkan Detail Nilai berdasarkan kode nilai 
	
	http://pingsmart.gallerysneakers27.com/api/nilai-detail-by-guru?kode=10000001&token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	
	***/
	
	public function actionNilaiDetailByGuru($kode,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = NilaiDetail::find()->where(['Kode' => $kode])->all();
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'NIS' => $q->NIS,
					'Nama' => $q->siswa->member->Nama,
					'KodePel' => $q->KodePel,
					'Nilai' => $q->Nilai,
					'Standar' => $q->Standar,
					'IdStat' => $q->IdStat,
					'Status' => $q->status->Status,
					'TglInput' => $q->TglInput,
					'Keterangan' => $q->Keterangan,
					]);
				}
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrdata, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
    
	/** Membuat Nilai Siswa
	
	http://pingsmart.gallerysneakers27.com/api/nilai-create?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm&kodekelas=1 B&idjenis=2&tanggal=2018-11-26&keterangan=OKE&kodepel=EKO
	
	***/
    
	public function actionNilaiCreate($token,$kodekelas,$idjenis,$tanggal,$keterangan,$kodepel){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$nilai=new Nilai();
				$nilai->KodeKelas=$kodekelas;
				$nilai->IdJenis=$idjenis;
				$nilai->Tanggal=$tanggal;
				$nilai->Keterangan=$keterangan;
				$nilai->IdPeg=$model->member->pegawai->IdPeg;
				$nilai->KodePel=$kodepel;
				
				$nilai->genKode($nilai->IdJenis);

				$arrstat=array();
				if($nilai->save()){
					
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => 'Data berhasil disimpan', ];
				}
				else{
				$result = ['response_code' => 0, 'messages' => 'Gagal', 'status' => true, 'data' => 'Data gagal disimpan', ];
				}
				
				
				return \yii\helpers\Json::encode($result);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/** Membuat Nilai Detail Siswa
	
	http://pingsmart.gallerysneakers27.com/api/nilai-detail-add?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm&kode=10000002&nis=990002&nilai=8&standar=7&idstat=1&keterangan=
	
	***/    
    
	public function actionNilaiDetailAdd($token,$kode,$nis,$nilai,$standar,$idstat,$keterangan){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$nilaidetail=new NilaiDetail();
				$nilaidetail->Kode=$kode;
				$nilaidetail->NIS=$nis;
				$nilaidetail->Nilai=$nilai;
				$nilaidetail->Standar=$standar;
				$nilaidetail->IdStat=$idstat;
				$nilaidetail->KodePel=Nilai::find()->where(['Kode' => $nilaidetail->Kode])->one()->KodePel;
				$nilaidetail->Keterangan=$keterangan;

				if($nilaidetail->save()){
    				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => 'Data berhasil disimpan', ];
				}
				else{
    				$result = ['response_code' => 0, 'messages' => 'Gagal', 'status' => true, 'data' => 'Data gagal disimpan', ];
				}
				
				
				return \yii\helpers\Json::encode($result);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}


	/** Mengubah Nilai Detail Siswa
	
	http://pingsmart.gallerysneakers27.com/api/nilai-detail-update?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm&id=39&kode=10000003&nis=990003&nilai=85&standar=75&idstat=1&keterangan=
	
	***/    
    
	public function actionNilaiDetailUpdate($token,$id,$kode,$nis,$nilai,$standar,$idstat,$keterangan){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$nilaidetail=NilaiDetail::find()->where(['Id' => $id])->one();
				$nilaidetail->Kode=$kode;
				$nilaidetail->NIS=$nis;
				$nilaidetail->Nilai=$nilai;
				$nilaidetail->Standar=$standar;
				$nilaidetail->IdStat=$idstat;
				$nilaidetail->KodePel=Nilai::find()->where(['Kode' => $nilaidetail->Kode])->one()->KodePel;
				$nilaidetail->Keterangan=$keterangan;

				if($nilaidetail->save()){
    				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => 'Data berhasil diubah', ];
				}
				else{
    				$result = ['response_code' => 0, 'messages' => 'Gagal', 'status' => true, 'data' => 'Data gagal diubah', ];
				}
				
				
				return \yii\helpers\Json::encode($result);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/** Menampilkan Detail Nilai Semuanya
	
	http://pingsmart.gallerysneakers27.com/api/nilai-detail-by-all?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm
	
	***/
	
	public function actionNilaiDetailByAll($token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = NilaiDetail::find()->all();
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'NIS' => $q->NIS,
					'Nama' => $q->siswa->member->Nama,
					'KodePel' => $q->KodePel,
					'Nilai' => $q->Nilai,
					'Standar' => $q->Standar,
					'IdStat' => $q->IdStat,
					'Status' => $q->status->Status,
					'TglInput' => $q->TglInput,
					'Keterangan' => $q->Keterangan,
					]);
				}
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrdata, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}


	/** Menghapus Nilai Detail Siswa
	
	http://pingsmart.gallerysneakers27.com/api/nilai-detail-remove?token=jsh6N7mfFq5oDAEbOTpVH_m4tiWcW9bm&id=37
	
	***/        
    
	public function actionNilaiDetailRemove($token,$id){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$nilai=NilaiDetail::find()->where(['Id' => $id])->one();
				
				if($nilai->delete()){
    				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => 'Data berhasil dihapus', ];
				}
				else{
    				$result = ['response_code' => 0, 'messages' => 'Gagal', 'status' => true, 'data' => 'Data gagal dihapus', ];
				}
				
				
				return \yii\helpers\Json::encode($result);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
    
	/* GURU END */
    
	/* -------------------------------------------------------------------- */
	
	/* WALI */
	
	/* 
	fungsi authentifikasi untuk login dan mengambil token
	token disimpan sebagai authkey untuk tahap berikutnya
    
    http://pingsmart.gallerysneakers27.com/api/auth-wali?uagent=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O&user=abduh&pass=123456
    
	*/
	
	public function actionAuthWali($uagent,$user,$pass)
    {
      
		if (isset($uagent)){
			// $username=base64_decode($user);
			// $password=base64_decode($pass);
			$username=$user;
			$password=$pass;	
			
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
					'IdStat' => $model->member->status->Status,
					'ActivationDate' => $model->member->ActivationDate,
					'ExpiredDate' => $model->member->ExpiredDate,
					'RemainPeriode' => $model->member->RemainPeriode,
					'Paket' => '',
					'Token' => $model->AuthKey,
				]);
				
				$model->setLoggedIn();
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrid, ];
				return \yii\helpers\Json::encode($result);
			
			}
			else{
				$result = ['response_code' => 0, 'messages' => 'Username / Password Salah', 'status' => true, 'data' => 'Username / Password Salah'];
				return \yii\helpers\Json::encode($result);
			}
		}
		else{
			return "Invalid Authentication Request";
		}
		
    }


    /*
    
    http://pingsmart.yukbaca.com/api/check-status?token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
    
    */

	public function actionCheckStatus($token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$arrchild=array();
				array_push($arrchild,[
					
					'Id' => $model->Id,
					'MemberId' => $model->MemberId,
					'Nama' => $model->member->Nama,
					'IdStat' => $model->member->IdStat,
					'Status' => $model->member->status->Status,
				]);
				
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrchild, ];
				return \yii\helpers\Json::encode($result);
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
	
	http://pingsmart.yukbaca.com/api/show-paket?token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	
	*/
	
	public function actionShowPaket($token){
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$bank =	Plan::find()->all();
				$arrObject=array();
				foreach($bank as $model){
    				array_push($arrObject,[
    					
    					'Id' => $model->Id,
    					'Kode' => $model->Kode,
    					'Plan' => $model->Plan,
    					'Durasi' => $model->Durasi,
    					'Harga' => $model->Harga,
    					'Keterangan' => $model->Keterangan,
    				]);
				}

				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
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
	
	http://pingsmart.yukbaca.com/api/show-bank?token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	
	*/
	
	public function actionShowBank($token){
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$bank =	BankAccount::find()->all();
				$arrObject=array();
				foreach($bank as $model){
    				array_push($arrObject,[
    					
    					'Id' => $model->Id,
    					'Bank' => $model->Bank,
    					'Rekening' => $model->Rekening,
    					'Nama' => $model->Nama,
    				]);
				}

				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
	}
	
	public function actionPelajaran(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$arrdata=array();
				$query=Pelajaran::find()->all();
				
				foreach ($query as $q){
					
					array_push($arrdata,[
					
						'Id' => $q->Id,
						'Kode' => $q->Kode,
						'Pelajaran' => $q->Pelajaran,
						'IdGroup' => $q->IdGroup,
						'Group' => $q->group->Group,
					]);
					
				}
				
				return \yii\helpers\Json::encode($arrdata);
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
	
	http://pingsmart.yukbaca.com/api/buy-paket?kode=TMN90&token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	
	*/

	public function actionBuyPaket($kode,$token){
		
		if (isset($token)){
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
												
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
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
	
	http://pingsmart.yukbaca.com/api/payment-confirm?invno=TMN90&token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O&jumlah=50000&idpay=3&idbank=002&idbankasal=002&accountno=01928901&accountname=DanniRamdan
	
	*/

	public function actionPaymentConfirm($invno,$token,$jumlah,$idpay,$idbank,$idbankasal,$accountno,$accountname){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$p = Plan::find()->where(['Kode' => $invo])->one();
				
				$arrObject=array();
				array_push($arrObject,[
					'TrxId' => '1234',
					'KodePembayaran' => 'PAY1234',
					'Jumlah' => '50000',
					'IdStat' => '1',
					'Status' => 'Pending',
					
					]);
												
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
		
	}

	/* WALI END */

	/* -------------------------------------------------------------------- */
	
	/* SISWA */
	
	
	/* 
	fungsi authentifikasi untuk login dan mengambil token
	token disimpan sebagai authkey untuk tahap berikutnya
    
    http://pingsmart.yukbaca.com/api/auth?uagent=MXWB-7Myn7my18tjZtKFN7Igk16bw6T8&user=veronica&pass=danniramdan
    
	*/
	
	public function actionAuth($uagent,$user,$pass)
    {
      
		if (isset($uagent)){
			// $username=base64_decode($user);
			// $password=base64_decode($pass);
			$username=$user;
			$password=$pass;	
			
			$model=User::findByUsername($username);
			
			//if($model->PasswordResetToken == null){$model->generatePasswordResetToken();}
			
			if(Yii::$app->security->validatePassword($password, $model->Password) == 1){
												
				$arrid=array();
				array_push($arrid,[
					'Id' => $model->member->Id,
					'Nama' => $model->member->Nama,
					'MemberId' => $model->MemberId,
					'NIS' => $model->member->siswa->NIS,
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
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrid, ];
				return \yii\helpers\Json::encode($result);
			
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
	
	http://pingsmart.yukbaca.com/api/show-my-child?token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	
	**/
	
	public function actionShowMyChild($token){
		
		if (isset($token)){
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

    /*
	fungsi siswa profile	
	http://pingsmart.yukbaca.com/api/siswa-profile-wali?nis=990014&token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	*/

	public function actionSiswaProfileWali($nis, $token){
		
		if (isset($token)){
			// $token=$token;
			// $nis=$nis;
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['Nis'=>$nis])->one();
				
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
				
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrsiswa, ];
				return \yii\helpers\Json::encode($result);
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
	fungsi siswa profile	
	http://pingsmart.gallerysneakers27.com/api/siswa-profile?nis=990014&token=MXWB-7Myn7my18tjZtKFN7Igk16bw6T8
	*/

	public function actionSiswaProfile($nis, $token){
		
		if (isset($token)){
			// $token=$token;
			// $nis=$nis;
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
				
				
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrsiswa, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/**
	fungsi siswa jadwal
	http://pingsmart.yukbaca.com/api/siswa-jadwalwali?nis=990003&token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	*/
	
	public function actionSiswaJadwalwali($nis,$token){
		
		if (isset($token)){
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
								
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	/**
	fungsi siswa jadwal
	http://pingsmart.gallerysneakers27.com/api/siswa-jadwal?nis=990014&token=MXWB-7Myn7my18tjZtKFN7Igk16bw6T8
	*/
	
	public function actionSiswaJadwal($nis,$token){
		
		if (isset($token)){
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
								
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/**
	fungsi tagihan siswa
	http://pingsmart.yukbaca.com/api/siswa-billingwali?nis=990003&token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	*/
	
	public function actionSiswaBillingwali($nis,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$arrObject = array(
				  array(
					"Id"=> 1,
					"Deskripsi"=> "Tagihan Bulan Maret",
					"Jumlah"=> "400000",
					"JatuhTempo"=> "2017-04-01",
					"Status"=> "Lunas",
					"Keterangan"=> ""
				  ),
				  array(
					"Id"=> 2,
					"Deskripsi"=> "Tagihan Bulan April",
					"Jumlah"=> "400000",
					"JatuhTempo"=> "2017-05-01",
					"Status"=> "Belum Dibayar",
					"Keterangan"=> ""
				  ),
				  array(
					"Id"=> 3,
					"Deskripsi"=> "Tagihan Bulan Mei",
					"Jumlah"=> "400000",
					"JatuhTempo"=> "2017-06-01",
					"Status"=> "Belum Dibayar",
					"Keterangan"=> ""
				  )
				);

				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
				
				/*
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
				*/
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/**
	fungsi tagihan siswa
	http://pingsmart.gallerysneakers27.com/api/siswa-billing?nis=990014&token=MXWB-7Myn7my18tjZtKFN7Igk16bw6T8
	*/
	
	public function actionSiswaBilling($nis,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$arrObject = array(
				  array(
					"Id"=> 1,
					"Deskripsi"=> "Tagihan Bulan Maret",
					"Jumlah"=> "400000",
					"JatuhTempo"=> "2017-04-01",
					"Status"=> "Lunas",
					"Keterangan"=> ""
				  ),
				  array(
					"Id"=> 2,
					"Deskripsi"=> "Tagihan Bulan April",
					"Jumlah"=> "400000",
					"JatuhTempo"=> "2017-05-01",
					"Status"=> "Belum Dibayar",
					"Keterangan"=> ""
				  ),
				  array(
					"Id"=> 3,
					"Deskripsi"=> "Tagihan Bulan Mei",
					"Jumlah"=> "400000",
					"JatuhTempo"=> "2017-06-01",
					"Status"=> "Belum Dibayar",
					"Keterangan"=> ""
				  )
				);

				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
				
				/*
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
				*/
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/**
	fungsi nilai ulangan
	http://pingsmart.yukbaca.com/api/siswa-nilai-ulanganwali?nis=990014&token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	*/
	
	public function actionSiswaNilaiUlanganwali($nis,$token){
		
		if (isset($token)){
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
	
	
	/**
	fungsi nilai ulangan
	http://pingsmart.gallerysneakers27.com/api/siswa-nilai-ulangan?nis=990003&token=m_8XCg60GT0a3ESBvs9yL3MU7k2PPHr2
	*/
	
	public function actionSiswaNilaiUlangan($nis,$token){
		
		if (isset($token)){
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
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
								
				return \yii\helpers\Json::encode($result);
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
	
	/**
	fungsi Album siswa
	http://pingsmart.gallerysneakers27.com/api/siswa-album?nis=990003&token=m_8XCg60GT0a3ESBvs9yL3MU7k2PPHr2
	*/
	
	public function actionSiswaAlbum($nis, $token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=GaleryAlbum::find()->where(['MemberId'=>$s->MemberId])->all();
				
				$arrObject=array();
				foreach ($query as $q){
					array_push($arrObject,[
					'Id' => $q->Id,
					'Album' => $q->Album,
					'Cover' => 'frontend/images/galery/cover/'.$q->Cover,
					'Created' => '2017-05-01',
					]);
				}

				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/**
	fungsi Galery siswa
	http://pingsmart.gallerysneakers27.com/api/siswa-galery?nis=990003&idalbum=3&token=m_8XCg60GT0a3ESBvs9yL3MU7k2PPHr2
	*/
	
	public function actionSiswaGalery($nis,$idalbum,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Galery::find()->where(['MemberId'=>$s->MemberId,'IdAlb' => $idalbum])->all();
				
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
								
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	/**
	fungsi Galery siswa
	http://pingsmart.gallerysneakers27.com/api/siswa-galery-view?nis=990003&idgal=1&token=m_8XCg60GT0a3ESBvs9yL3MU7k2PPHr2
	*/
	
	public function actionSiswaGaleryView($nis,$idgal,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$q=Galery::find()->where(['MemberId'=>$s->MemberId,'Id' => $idgal])->one();
				
				$arrObject=array();
				
				array_push($arrObject,[
				'Id' => $q->Id,
				'Judul' => $q->Judul,
				'Image' => 'frontend/images/galery/'.$q->Image,
				'Deskripsi' => $q->Deskripsi,
				'Album' => $q->album->Album,
				'Created' => $q->UploadTime,
				]);
								
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}


	/**
	fungsi Galery blocked siswa
	http://pingsmart.gallerysneakers27.com/api/siswa-galery-block?nis=990001&idgal=3&token=odqaqJXoikDvz1IruV25EZ4goAzERF7L
	*/
	
	public function actionSiswaGaleryBlock($nis,$idgal,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
						
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Galery::find()->where(['MemberId' => $s->MemberId,'Id' => $idgal])->one();
				$query->IdStat = 4;
				
		        if($query->save()){
				    $result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => 'Data berhasil disimpan', ];
		        }else{
    				$result = ['response_code' => 0, 'messages' => 'Gagal', 'status' => true, 'data' => 'Data gagal disimpan', ];
		        }
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}


	/**
	fungsi Galery blocked siswa
	http://pingsmart.gallerysneakers27.com/api/siswa-galery-blocked?nis=990001&token=odqaqJXoikDvz1IruV25EZ4goAzERF7L
	*/
	
	public function actionSiswaGaleryBlocked($nis,$token){
		
		if (isset($token)){
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
								
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/**
	fungsi Galery Terbaru siswa
	http://pingsmart.gallerysneakers27.com/api/siswa-galery-latest?nis=990003&idalbum=3&token=m_8XCg60GT0a3ESBvs9yL3MU7k2PPHr2
	*/
	
	public function actionSiswaGaleryLatest($nis,$idalbum,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Galery::find()->where(['MemberId'=>$s->MemberId,'IdAlb' => $idalbum])->orderBy(['Id'=>SORT_DESC])->all();
				
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
								
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	/**
	fungsi Galery Top siswa
	http://pingsmart.gallerysneakers27.com/api/siswa-galery-top?nis=990003&idalbum=3&token=m_8XCg60GT0a3ESBvs9yL3MU7k2PPHr2
	*/
	
	public function actionSiswaGaleryTop($nis,$idalbum,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
			    
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Galery::find()->where(['MemberId'=>$s->MemberId,'IdAlb' => $idalbum])->orderBy(['Id'=>SORT_DESC])->all();
				
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
								
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/**
	fungsi pengumuman siswa	
	http://pingsmart.yukbaca.com/api/pengumumanwali?nis=990003&token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	
	*/
	
	public function actionPengumumanwali($nis,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Pengumuman::find()->where(['IdStat' => 2])->andFilterWhere(['LIKE','KodeKelas',$s->KodeKelas])->all();
				
				$arrObject=array();
				array_push($arrObject,$query);
												
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}

	/**
	fungsi pengumuman view siswa	
	http://pingsmart.yukbaca.com/api/pengumuman-viewwali?nis=990003&id=1&token=TGPXtvB-iPlwrFOVC8e5wOSlIXVbXc7O
	*/
	
	public function actionPengumumanViewwali($nis,$id,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Pengumuman::find()->where(['IdStat' => 2,'Id' => $id])->all();
				
				$arrObject=array();
				array_push($arrObject,$query);
												
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	/**
	fungsi pengumuman siswa	
	http://pingsmart.gallerysneakers27.com/api/pengumuman?nis=990003&token=m_8XCg60GT0a3ESBvs9yL3MU7k2PPHr2
	*/
	
	public function actionPengumuman($nis,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Pengumuman::find()->where(['IdStat' => 2])->andFilterWhere(['LIKE','KodeKelas',$s->KodeKelas])->all();
				
				$arrObject=array();
				array_push($arrObject,$query);
												
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	/**
	fungsi pengumuman view siswa	
	http://pingsmart.gallerysneakers27.com/api/pengumuman-view?nis=990003&id=1&token=m_8XCg60GT0a3ESBvs9yL3MU7k2PPHr2
	*/
	
	public function actionPengumumanView($nis,$id,$token){
		
		if (isset($token)){
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$s = Siswa::find()->where(['NIS'=>$nis])->one();
				$query=Pengumuman::find()->where(['IdStat' => 2,'Id' => $id])->all();
				
				$arrObject=array();
				array_push($arrObject,$query);
												
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrObject, ];
				return \yii\helpers\Json::encode($result);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	
	
	/*** general ***/
	
	
	
}