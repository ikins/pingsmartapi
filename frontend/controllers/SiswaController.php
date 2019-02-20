<?php

namespace frontend\controllers;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Siswa;
use common\models\SiswaBiodata;
use common\models\SiswaSearch;
use common\models\Member;
use common\models\User;
use common\models\Wali;
use common\models\SiswaWali;
use common\models\Galery;
use common\models\JadwalSearch;
use common\models\NilaiSearch;
use common\models\Nilai;
use common\models\NilaiDetail;
use common\models\NilaiDetailSearch;
use common\models\KelasAgenda;
use common\models\PengumumanSearch;
use common\models\Pengumuman;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;

/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

   	
	public function actionGetdata(){
		if($_POST['nis'] !== ''){
			$model=Siswa::find()->where(['NIS' => $_POST['nis']])->one();
			if($model == null){
				return 0;
				}
			else{
				$arrObj=array();
				array_push($arrObj,[
					'Id' => $model->Id,
					'Point' => $model->Point,
					'Kelas' => $model->kelas->Kelas,
					
				]);
				
				return \yii\helpers\Json::encode($arrObj);
				}  
		}
	}

	public function actionNilai()
    {	
    	$siswa=Siswa::find()->where(['MemberId' => Yii::$app->user->identity->member->MemberId])->one();

		$searchModel = new NilaiDetailSearch(['NIS' => $siswa->NIS]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('nilai', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNilaiView($id)
    {	

        $model=NilaiDetailSearch::find()->where(['Id' => $id])->one();;
		return $this->render('nilai_view', [
            'model' => $model,
        ]);
    }

	public function actionPelajaran()
    {
    	$siswa=Siswa::find()->where(['MemberId' => Yii::$app->user->identity->member->MemberId])->one();
        $searchModel = new JadwalSearch(['KodeKelas' => $siswa->KodeKelas]);
        $dataProvider = $searchModel->searchbyGuru(Yii::$app->request->queryParams);

        return $this->render('pelajaran', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAgenda()
    {
        $siswa=Siswa::find()->where(['MemberId' => Yii::$app->user->identity->member->MemberId])->one();

		$query = KelasAgenda::find()
		->where(['like', 'KodeKelas', '%' . $siswa->KodeKelas . '%', false])
		->andFilterWhere(['like', 'NIS', '%' . $siswa->NIS . '%', false]);
		$dataProvider = new ActiveDataProvider(['query' => $query,]);

        return $this->render('agenda', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAgendaView($id)
    {	

        $model=KelasAgenda::find()->where(['Id' => $id])->one();;
		return $this->render('agenda_view', [
            'model' => $model,
        ]);
    }

	public function actionPengumuman()
    {
        $siswa=Siswa::find()->where(['MemberId' => Yii::$app->user->identity->member->MemberId])->one();

		$query = PengumumanSearch::find()
		->where(['like', 'Target', '%' . Yii::$app->user->identity->member->IdLev . '%', false])
		->andFilterWhere(['like', 'KodeKelas', '%' . $siswa->KodeKelas . '%', false]);
		$dataProvider = new ActiveDataProvider(['query' => $query,]);

        return $this->render('pengumuman', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPengumumanView($id)
    {
        $model=Pengumuman::find()->where(['Id' => $id])->one();;
		return $this->render('pengumuman_view', [
            'model' => $model,
        ]);
    }
}
