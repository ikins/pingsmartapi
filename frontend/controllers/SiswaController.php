<?php

namespace frontend\controllers;

use Yii;
use yii\base\Model;
use common\models\Siswa;
use common\models\SiswaBiodata;
use common\models\SiswaSearch;
use common\models\Member;
use common\models\User;
use common\models\Wali;
use common\models\SiswaWali;
use common\models\Galery;
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
}
