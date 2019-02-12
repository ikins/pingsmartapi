<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\GuruAjar;
use common\models\Kelas;
use common\models\Siswa;
use common\models\SiswaSearch;
use common\models\Galery;
use common\models\JadwalSearch;
use common\models\NilaiSearch;
use common\models\Nilai;
use common\models\NilaiDetail;
use common\models\SiswaRecordSearch;
use common\models\SiswaRecord;
use common\models\PengumumanSearch;
use common\models\Pengumuman;
use common\models\KelasAgendaSearch;
use common\models\KelasAgenda;


class GuruController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','pengumuman','kelas','siswa','siswaview','siswa-galery-view','siswa-galery-ban','pelajaran','nilai','nilai-add','nilai-view','nilai-add-detail','nilai-remove-detail',
						'pelanggaran','pelanggaran-add','pengumuman-add','pengumuman-view','agenda','kelasagenda-add','kelasagenda-view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
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
        return $this->redirect(['/guru/index']);
    }
	
	public function actionKelas()
    {
        $kelas=GuruAjar::find()->select('KodeKelas')->where(['IdPeg' => Yii::$app->user->identity->member->pegawai->IdPeg])->distinct()->all();
		return $this->render('kelas',['kelas' => $kelas]);
    }
	
	public function actionSiswa($id='')
    {
        
		if(isset($id)){
			$model=Kelas::find()->where(['Id' => $id])->one();
			$searchModel = new SiswaSearch(['KodeKelas' => $model->Kode]);
		}
		
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('siswa', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionSiswaview($id){
		$model=Siswa::find()->where(['Id' => $id])->one();
		
		$galeri=Galery::find()->where(['MemberId' => $model->MemberId])->all();
			
		return $this->render('siswaview',[
			'model' => $model,
			'galeri' => $galeri,
			]);
		
	}
	
	public function actionSiswaGaleryView($id){
				
		$model=Galery::findOne($id);
			
		return $this->render('siswa_galery_view',[
			'model' => $model,
			]);
		
	}
	
	public function actionSiswaGaleryBan($id){
				
		$model=Galery::findOne($id);
			
		$model->IdStat=4;
		$model->ModID=Yii::$app->user->identity->MemberId;
		
		$model->save();
		return $this->redirect(Yii::$app->request->referrer);
				
	}
	
	public function actionPelajaran()
    {
        $searchModel = new JadwalSearch(['IdGuru' => Yii::$app->user->identity->member->pegawai->IdPeg]);
        $dataProvider = $searchModel->searchbyGuru(Yii::$app->request->queryParams);

        return $this->render('pelajaran', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionNilai()
    {
        $searchModel = new NilaiSearch(['IdPeg' => Yii::$app->user->identity->member->pegawai->IdPeg]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('nilai', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionNilaiAdd()
    {
        $model = new Nilai();

        if($model->load(Yii::$app->request->post())){
			$model->genKode($model->IdJenis);
			if($model->save()){
				return $this->redirect(['/guru/nilai-view', 'id' => $model->Id]);
			}
			else{
				return $this->render('nilai-add', [
					'model' => $model,
				]);
			}
			
		}
		else{
			return $this->render('nilai_add', [
                'model' => $model,
            ]);
		}
    }
	
	public function actionNilaiView($id)
    {
        $model=Nilai::find()->where(['Id' => $id])->one();;
		return $this->render('nilai_view', [
            'model' => $model,
        ]);
    }
	
	public function actionNilaiAddDetail()
	{
		if(isset($_POST['NIS'])){
			
			$model=new NilaiDetail;
			$model->NIS=$_POST['NIS'];
			$model->Kode=$_POST['Kode'];
			$model->Nilai=$_POST['Nilai'];
			$model->KodePel=$_POST['KodePel'];
			$model->IdStat=$_POST['IdStat'];
			if($model->save()){
				
				return '{"Status":1,"Keterangan":"Berhasil Simpan Data"}';	
			}
			else{
				return '{"Status":2,"Keterangan":"Gagal"}';	
			}
		}
		else{
			return '{"Status":3,"Keterangan":"No Data"}';
		}
	}
	
	public function actionNilaiRemoveDetail()
	{
		if(isset($_POST['id'])){
			$model=NilaiDetail::find()->where(['Id' => $_POST['id']])->one();
			if($model->delete()){
				
				return '{"Status":1,"Keterangan":"Berhasil Hapus Data"}';	
			}
			else{
				return '{"Status":2,"Keterangan":"Gagal"}';	
			}
		}
		else{
			return '{"Status":3,"Keterangan":"No Data"}';
		}
	}
	
	public function actionPelanggaran()
    {
        $searchModel = new SiswaRecordSearch(['IdPeg' => Yii::$app->user->identity->member->pegawai->IdPeg]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pelanggaran', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionPelanggaranAdd()
    {
        $model = new SiswaRecord();

        if($model->load(Yii::$app->request->post())){
			
			if($model->save()){
				$siswa=Siswa::find()->where(['NIS' => $model->NIS])->one();
				$siswa->DemotePoint($model->NIS,$model->Point);
				return $this->redirect(['/guru/pelanggaran']);
			}
			else{
				return $this->render('pelanggaran_add', [
					'model' => $model,
				]);
			}
			
		}
		else{
			return $this->render('pelanggaran_add', [
                'model' => $model,
            ]);
		}
    }
	
	public function actionPengumuman()
    {
        $searchModel = new PengumumanSearch(['IdPeg' => Yii::$app->user->identity->member->pegawai->IdPeg]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pengumuman', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionPengumumanAdd()
    {
        $model = new Pengumuman();

        if($model->load(Yii::$app->request->post())){
			$post = Yii::$app->request->post();
			$model->Target=json_encode($post['Pengumuman']['Target']);
			$model->KodeKelas=json_encode($post['Pengumuman']['KodeKelas']);
			$model->Tanggal=date('Y-m-d');
			$model->IdPeg=Yii::$app->user->identity->member->pegawai->IdPeg;
			if($model->save()){
				return $this->redirect(['/guru/pengumuman']);
			}
			else{
				return $this->render('pengumuman_add', [
					'model' => $model,
				]);
			}
			
		}
		else{
			return $this->render('pengumuman_add', [
                'model' => $model,
            ]);
		}
    }
	
	public function actionPengumumanView($id)
    {
        $model=Pengumuman::find()->where(['Id' => $id])->one();;
		return $this->render('pengumuman_view', [
            'model' => $model,
        ]);
    }
	
	
	public function actionAgenda()
    {
        $searchModel = new KelasAgendaSearch(['IdPeg' => Yii::$app->user->identity->member->pegawai->IdPeg]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('kelasagenda', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
	public function actionKelasagendaAdd()
    {
        $model = new KelasAgenda();
		$model->JamAwal='07:00';
		$model->JamAkhir='12:00';

        if($model->load(Yii::$app->request->post())){
			$post = Yii::$app->request->post();
			$model->KodeKelas=json_encode($post['KelasAgenda']['KodeKelas']);
			$model->NIS=json_encode($post['KelasAgenda']['NIS']);
			
			$model->IdPeg=Yii::$app->user->identity->member->pegawai->IdPeg;
			$model->IdStat=1;
			
			if($model->TglAkhir == null){$model->TglAkhir=$model->TglAwal;}
			if($model->save()){
				return $this->redirect(['/guru/agenda']);
			}
			else{
				return $this->render('kelasagenda_add', [
					'model' => $model,
				]);
			}
			
		}
		else{
			return $this->render('kelasagenda_add', [
                'model' => $model,
            ]);
		}
    }
	
	public function actionKelasagendaView($id)
    {
        $model=KelasAgenda::find()->where(['Id' => $id])->one();;
		return $this->render('kelasagenda_view', [
            'model' => $model,
        ]);
    }
}