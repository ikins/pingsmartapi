<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use common\models\Pegawai;
use common\models\PegawaiBiodata;
use common\models\PegawaiSearch;
use common\models\GuruAjarSearch;
use common\models\GuruAjar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class GuruController extends Controller
{
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

    public function actionIndex()
    {
        $searchModel = new PegawaiSearch(['IdJab' => 3]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionView($id)
    {
        $model=$this->findModel($id);
		$searchModel = new GuruAjarSearch(['IdPeg' => $model->IdPeg]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('view', [
            'model' => $model,
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	protected function findModel($id)
    {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionAddPelajaran()
	{
		$model=new GuruAjar;
		if (isset($_POST['IdPeg'])){
			$model->IdPeg=$_POST['IdPeg'];
			$model->KodePel=$_POST['KodePel'];
			$model->KodeKelas=$_POST['KodeKelas'];
			$model->Keterangan=$_POST['Keterangan'];
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
}