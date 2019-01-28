<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;

use common\models\User;
use common\models\BankAccount;
use common\models\Pelajaran;
class GeneralController extends Controller
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
	
	public function actionCheckStatus(){
		
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				
				$arrchild=array();
				array_push($arrchild,[
					
					'Id' => $model->Id,
					'MemberId' => $model->MemberId,
					'IdStat' => $model->member->IdStat,
					'Status' => $model->member->status->Status,
				]);
				
				
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
	
	public function actionShowBank(){
		if (isset($_POST['token'])){
			$token=$_POST['token'];
			$model=User::findByAuthKey($token);
			
			if($model != null){
				$b = BankAccount::find()->all();
				$arrObject=array();
				array_push($arrObject,$b);
												
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
	
}