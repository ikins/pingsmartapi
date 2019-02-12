<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\Cors;

use common\models\User;
use common\models\Siswa;
use common\models\SiswaWali;
use common\models\Jadwal;
use common\models\NilaiDetail;
use common\models\GaleryAlbum;
use common\models\Galery;
use common\models\Pengumuman;
use common\models\Plan;
class SiswaController extends Controller
{	

	public function behaviors()
	{
	    return [
	        'corsFilter' => [
	            'class' => \yii\filters\Cors::className(),
	            'cors' => [
	                // restrict access to
	                'Origin' => ['*'],
	                // Allow only POST and PUT methods
	                'Access-Control-Request-Method' => ['POST', 'PUT', 'GET'],
	                // Allow only headers 'X-Wsse'
	                'Access-Control-Request-Headers' => ['X-Wsse'],
	                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
	                'Access-Control-Allow-Credentials' => true,
	                // Allow OPTIONS caching
	                'Access-Control-Max-Age' => 3600,
	                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
	                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
	            ],

	        ],
	    ];
	}
    
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
	
	/*public function actionAuth()
    {
      
		if (isset($_POST['uagent'])){
			$username=base64_decode($_POST['username']);
			$password=base64_decode($_POST['password']);
							
			$model=User::findByUsername($username);
			
			//if($model->PasswordResetToken == null){$model->generatePasswordResetToken();}
			
			if(Yii::$app->security->validatePassword($password, $model->Password) == 1){
												
				$arrid=array();
				array_push($arrid,[
					'Id' => $model->member->Id,
					'NIS' => $model->member->siswa->NIS,
					'Nama' => $model->member->Nama,
					'MemberId' => $model->MemberId,
					'Priviledges' => $model->priviledges->Priviledges,
					'PrivId' => $model->IdPriv,
					'Avatar' => $model->member->Avatar,
					'Email' => $model->Email,
					'IdLev' => $model->member->IdLev,
					'Level' => $model->member->level->Level,
					'IsVerified' => $model->IsVerified,
					'IdStat' => $model->member->IdStat,
					'IdStat' => $model->member->status->Status,
					'ActivationDate' =>Yii::$app->formatter->asDate($model->member->ActivationDate),
					'ExpirationDate' =>Yii::$app->formatter->asDate($model->member->ExpiredDate),
					'RemainPeriode' => $model->member->RemainPeriode,
					'Paket' => $model->member->KodePlan=' '?'':$model->member->plan->Plan,
					'Token' => $model->AuthKey,
					
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
		
    }*/


    /* 
	fungsi authentifikasi untuk login dan mengambil token
	token disimpan sebagai authkey untuk tahap berikutnya
    
    http://pingsmart.yukbaca.com/siswa/auth?user=veronica&pass=danniramdan
    
	*/

    public function actionAuth($user,$pass)
    {
      
			$username=$user;
			$password=$pass;	
			
			$model=User::findByUsername($username);
			
			//if($model->PasswordResetToken == null){$model->generatePasswordResetToken();}
			
			//jika password & username sesuai
			// 02/02/2019
			if(($model != null) AND (Yii::$app->security->validatePassword($password, $model->Password) == 1)){

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
					'Token' => $model->AuthKey
				]);
				
				$model->setLoggedIn();
				$result = ['response_code' => 1, 'messages' => 'Berhasil', 'status' => true, 'data' => $arrid, ];
				return \yii\helpers\Json::encode($result);
			
			}
			else{
				$result = ['response_code' => 0, 'messages' => 'Username/Password Salah', 'status' => true ];
				return \yii\helpers\Json::encode($result);
			}
		
    }
}