<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;

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
		
    }
}