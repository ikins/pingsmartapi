<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;

use common\models\User;
use common\models\GuruAjar;
use common\models\Siswa;
use common\models\Jadwal;
use common\models\Nilai;
use common\models\NilaiDetail;
use common\models\SiswaRecord;
use common\models\Pengumuman;
use common\models\MemberLevel;
use common\models\Pelanggaran;
use common\models\Kelas;
use common\models\KelasAgenda;
use common\models\SiswaBiodata;
class GuruController extends Controller
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
	action untuk menampilkan kelas yang diajar oleh guru ybs
	**/
	
	public function actionShowMyClass(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
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
				  if (isset($result[$id])) {
					 $result[$id][] = $data;
				  } else {
					 $result[$id] = array($data);
				  }
				}

				//var_dump($group);
				
				
				
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
	**/
	
	public function actionSiswaByKelas(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$kodekls=$_POST['kodekelas'];
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
					'Point' => $q->Point,
					'Masuk' => '07:00',
					'Ranking' =>'',
					'Foto' =>$q->biodata->Foto,
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
	action untuk menampilkan data siswa berdasarkan kode kelas
	**/
	
	public function actionSchedule(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				//return $model->member->pegawai->IdPeg;
				$query = Jadwal::find()->where(['IdGuru' => $model->member->pegawai->IdPeg])->all();
				$arrchild=array();
				foreach ($query as $q){
					array_push($arrchild,[
					'Id' => $q->Id,
					'IdHari' => $q->IdHari,
					'Hari' => $q->hari->Hari,
					'KodeKelas' => $q->KodeKelas,
					'Kelas' => $q->kelas->Kelas,
					'KodePelajaran' => $q->KodePel,
					'Pelajaran' => $q->pelajaran->Pelajaran,
					'JamMulai' => $q->JamMulai,
					'JamSelesai' => $q->JamAkhir,
					'Keterangan' => $q->Keterangan,
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
	
	/*** cek present schedule ***/
	public function actionRefresh(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			$jd=new Jadwal;	
			if($model != null){
				$arrid=array();
				array_push($arrid,[
					
					'NIP' => $model->member->pegawai->NIP,
					'JamAjar' => $jd->getTeachingHour($model->member->pegawai->IdPeg),
					'KelasSekarang' =>'1A',
					'AjarSekarang' =>$jd->getNowSchedule($model->member->pegawai->IdPeg),
					'KelasBerikut' => '2B',
					'KelasBerikut' => $jd->getNextSchedule($model->member->pegawai->IdPeg),
					
				]);
				return \yii\helpers\Json::encode($arrid);
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	
	/*** list nilai ***/
	public function actionNilai(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
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
	
	/** detail nilai berdasarkan kode nilai ***/
	
	public function actionNilaiDetail(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$kode=$_POST['kode'];
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
	
	
	public function actionNilaiCreate(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$nilai=new Nilai();
				$nilai->KodeKelas=$_POST['kodekelas'];
				$nilai->IdJenis=$_POST['idjenis'];
				$nilai->Tanggal=$_POST['tanggal'];
				$nilai->Keterangan=$_POST['keterangan'];
				$nilai->IdPeg=$model->member->pegawai->IdPeg;
				$nilai->KodePel=$_POST['kodepel'];
				
				$nilai->genKode($nilai->IdJenis);
				
				$arrstat=array();
				if($nilai->save()){
					
					array_push($arrstat,[
						
						'Id' => 1,
						'Status' => 'Berhasil',
												
					]);
				}
				else{
					array_push($arrstat,[
						
						'Id' => 0,
						'Status' => 'Gagal',
												
					]);
				}
				
				
				return \yii\helpers\Json::encode($arrstat);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionNilaiDetailAdd(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$nilai=new NilaiDetail();
				$nilai->Kode=$_POST['kode'];
				$nilai->NIS=$_POST['nis'];
				$nilai->Nilai=$_POST['nilai'];
				$nilai->Standar=$_POST['standar'];
				$nilai->IdStat=$_POST['idstat'];
				$nilai->KodePel=Nilai::find()->where(['Kode' => $nilai->Kode])->one()->KodePel;
				$nilai->Keterangan=$_POST['keterangan'];
				
				
				$arrstat=array();
				if($nilai->save()){
					
					array_push($arrstat,[
						
						'Id' => 1,
						'Status' => 'Berhasil',
												
					]);
				}
				else{
					array_push($arrstat,[
						
						'Id' => 0,
						'Status' => 'Gagal',
												
					]);
				}
				
				
				return \yii\helpers\Json::encode($arrstat);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	public function actionNilaiDetailRemove(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$id=$_POST['id'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$nilai=NilaiDetail::find()->where(['Id' => $id])->one();
				
				$arrstat=array();
				if($nilai->delete()){
					
					array_push($arrstat,[
						
						'Id' => 1,
						'Status' => 'Berhasil Hapus Nilai',
												
					]);
				}
				else{
					array_push($arrstat,[
						
						'Id' => 0,
						'Status' => 'Gagal',
												
					]);
				}
				
				
				return \yii\helpers\Json::encode($arrstat);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	
	/*** list pelanggaran ***/
	public function actionPelanggaran(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = SiswaRecord::find()->where(['IdPeg' => $model->member->pegawai->IdPeg])->all();
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'Tanggal' => $q->Tanggal,
					'NIS' => $q->NIS,
					'Nama' => $q->siswa->member->Nama,
					'IdPel' => $q->IdPel,
					'Pelanggaran' => $q->pelanggaran->Pelanggaran,
					'IdKat' => $q->pelanggaran->IdKat,
					'Kategori' => $q->pelanggaran->kategori->Kategori,
					'Point' => $q->Point,
					'Keterangan' => $q->Keterangan,
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
	
	/** input pelanggaran**/
	public function actionPelanggaranAdd(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$rc=new SiswaRecord();
				$rc->Tanggal=$_POST['tanggal'];
				$rc->NIS=$_POST['nis'];
				$rc->IdPel=$_POST['idpel'];
				$rc->Point=$_POST['point'];
				$rc->IdPeg=$model->member->pegawai->IdPeg;
				$rc->Keterangan=$_POST['keterangan'];
				
				
				$arrstat=array();
				if($rc->save()){
					
					array_push($arrstat,[
						
						'Id' => 1,
						'Status' => 'Berhasil',
												
					]);
				}
				else{
					array_push($arrstat,[
						
						'Id' => 0,
						'Status' => 'Gagal',
												
					]);
				}
				
				
				return \yii\helpers\Json::encode($arrstat);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	
	
	
	/*** list pengumuman ***/
	public function actionPengumuman(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = Pengumuman::find()->where(['IdPeg' => $model->member->pegawai->IdPeg])->all();
							
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'Tanggal' => $q->Tanggal,
					'Judul' => $q->Judul,
					'Target' => $this->readTarget($q->Target),
					'Kelas' => $this->readKelas($q->KodeKelas),
					'BeginPublish' => $q->BeginPublish,
					'EndPublish' => $q->EndPublish,
					'Keterangan' => $q->Keterangan,
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
	
	public function actionPengumumanDetail(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$kode=$_POST['id'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = Pengumuman::find()->where(['Id' => $kode])->all();
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'Tanggal' => $q->Tanggal,
					'Judul' => $q->Judul,
					'Pengumuman' => $q->Pengumuman,
					'Target' => $this->readTarget($q->Target),
					'Kelas' => $this->readKelas($q->KodeKelas),
					'BeginPublish' => $q->BeginPublish,
					'EndPublish' => $q->EndPublish,
					'Keterangan' => $q->Keterangan,
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
	
	public function actionPengumumanAdd(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$p=new Pengumuman();
				$p->Tanggal=$_POST['tanggal'];
				$p->Judul=$_POST['judul'];
				$p->Pengumuman=$_POST['pengumuman'];
				$p->Target=$_POST['target'];
				$p->KodeKelas=$_POST['kodekelas'];
				$p->BeginPublish=$_POST['beginpublish'];
				$p->EndPublish=$_POST['endpublish'];
				$p->Keterangan=$_POST['keterangan'];
				$p->IdStat=2;
				$p->IdPeg=$model->member->pegawai->IdPeg;
				
				
				$arrstat=array();
				if($p->save()){
					
					array_push($arrstat,[
						
						'Id' => 1,
						'Status' => 'Berhasil',
												
					]);
				}
				else{
					array_push($arrstat,[
						
						'Id' => 0,
						'Status' => 'Gagal',
												
					]);
				}
				
				
				return \yii\helpers\Json::encode($arrstat);
				
			}
			else{
				return "Invalid Token";
			}
			
		}
		else{
			return "Invalid Request";
		}
			
	}
	
	function readTarget($json){
		$str='';
		$target=json_decode($json);
		if (count($target) > 0){
			$level=MemberLevel::find()->where(['in','Id',$target])->all();
			foreach($level as $l){$str=$str.$l->Level.', ';}
		
		}
		return $str;
	}
	
	function readKelas($json){
		$str='';
		$kelas=json_decode($json);
		if (count($kelas) > 0){
			$kls=Kelas::find()->where(['in','Kode',$kelas])->all();
			foreach($kls as $k){$str=$str.$k->Kelas.', ';}
		
		}
		return $str;
	}
	
	function readSiswa($json){
		$str='';
		$siswas=json_decode($json);
		if (count($siswas) > 0){
			$siswa=SiswaBiodata::find()->where(['in','NIS',$siswas])->all();
			foreach($siswa as $s){$str=$str.$s->Nama.', ';}
		
		}
		return $str;
	}
	
	public function actionPelanggaranList(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = Pelanggaran::find()->all();
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'Pelanggaran' => $q->Pelanggaran,
					'Point' => $q->Point,
					'IdKat' => $q->IdKat,
					'Kategori' => $q->kategori->Kategori,
					'Keterangan' => $q->Keterangan,
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
	
	public function actionTargetList(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = MemberLevel::find()->all();
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'Level' => $q->Level,
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
	
	
	/** api agenda kelas **/
	
	/*** list agenda kelas ***/
	public function actionAgendaKelas(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = KelasAgenda::find()->where(['IdPeg' => $model->member->pegawai->IdPeg])->all();
							
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'Judul' => $q->Judul,
					'Deskripsi' => $q->Deskripsi,
					'Siswa' => $this->readSiswa($q->NIS),
					'Kelas' => $this->readKelas($q->KodeKelas),
					'TglAwal' => $q->TglAwal,
					'JamAwal' => $q->JamAwal,
					'TglAkhir' => $q->TglAkhir,
					'JamAkhir' => $q->JamAkhir,
					'Keterangan' => $q->Keterangan,
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
	
	public function actionAgendaKelasDetail(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$id=$_POST['id'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$query = KelasAgenda::find()->where(['Id' => $id])->all();
				$arrdata=array();
				foreach ($query as $q){
					array_push($arrdata,[
					'Id' => $q->Id,
					'Judul' => $q->Judul,
					'Deskripsi' => $q->Deskripsi,
					'Kelas' => $this->readKelas($q->KodeKelas),
					'NIS' => $this->readSiswa($q->NIS),
					'TglAwal' => $q->TglAwal,
					'JamAwal' => $q->JamAwal,
					'TglAkhir' => $q->TglAkhir,
					'JamAkhir' => $q->JamAkhir,
					'Keterangan' => $q->Keterangan,
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
	
	public function actionAgendaKelasAdd(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$p=new KelasAgenda();
				$p->Judul=$_POST['judul'];
				$p->Deskripsi=$_POST['deskripsi'];
				$p->NIS=$_POST['nis'];
				$p->KodeKelas=$_POST['kodekelas'];
				$p->TglAwal=$_POST['tglawal'];
				$p->JamAwal=$_POST['jamawal'];
				$p->TglAkhir=$_POST['tglakhir'];
				$p->JamAkhir=$_POST['jamakhir'];
				$p->Keterangan=$_POST['keterangan'];
				$p->IdStat=2;
				$p->IdPeg=$model->member->pegawai->IdPeg;
				
				
				$arrstat=array();
				if($p->save()){
					
					array_push($arrstat,[
						
						'Id' => 1,
						'Status' => 'Berhasil',
												
					]);
				}
				else{
					array_push($arrstat,[
						
						'Id' => 0,
						'Status' => 'Gagal',
												
					]);
				}
				
				
				return \yii\helpers\Json::encode($arrstat);
				
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
