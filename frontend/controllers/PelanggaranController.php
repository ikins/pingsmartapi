<?php

namespace frontend\controllers;

use Yii;
use common\models\Pelanggaran;
use common\models\PelanggaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PelanggaranController extends Controller
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

    
    protected function findModel($id)
    {
        if (($model = Pelanggaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionGetpoint(){
		if(isset($_POST['idpel'])){
			return $this->findModel($_POST['idpel'])->Point;
		}
		else{
			return "0";
		}
	}
}
