<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Event;

class CalendarController extends Controller
{
	
	public function actionIndex(){
		$agenda=Event::find()->where(['<','IdStat',3])->all();
		return $this->render('index',['agenda' => $agenda]);
	}
	
	public function actionView($id){
		$model=Event::find()->where(['Id' => $id])->one();
		$agenda=Event::find()->where(['<','IdStat',3])->all();
		return $this->render('view', [
            'model' => $model,
			'agenda' => $agenda
        ]);
	}
	
}