<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Kelas;

class AdminController extends Controller
{
	
		function actionResync(){
			
			$kelas=Kelas::find()->all();
			foreach ($kelas as $k){
				Yii::$app->db->createCommand("UPDATE kelas SET Jumlah = (SELECT COUNT(*) FROM siswa WHERE KodeKelas=:Kode) WHERE Kode=:Kode;")
					->bindValue(':Kode', $k->Kode)
					->execute();
			}
			
		}
}
 