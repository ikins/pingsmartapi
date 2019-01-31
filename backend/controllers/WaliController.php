<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use common\models\Wali;
use common\models\SiswaWali;
use common\models\SiswaWaliSearch;
use common\models\Member;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WaliController implements the CRUD actions for Wali model.
 */
class WaliController extends Controller
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

   
    public function actionIndex()
    {
        $searchModel = new SiswaWaliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($id)
    {
        
		$model=$this->findModel($id);
		$siswa=SiswaWali::find()->where(['KodeWali' => $model->Kode])->all();
		return $this->render('view', [
            'model' => $model,
			'siswa' => $siswa,
        ]);
    }

    
    public function actionCreate()
    {
        $model = new Wali();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

   
    protected function findModel($id)
    {
        if (($model = Wali::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionRegister($id)
    {
        
		$model=$this->findModel($id);
		$member=new Member;
		$user=new User;
		
		if ($user->load(Yii::$app->request->post())
			&& Model::validateMultiple([$model,$user])) {
				
			/** generate kode member ***/
			$member->Nama=$model->Nama;
			$member->GenKode();
			$member->IdStat=2;//registered
			$member->IdLev=5;//wali siswa
			
			$user->MemberId=$member->MemberId;
			$user->setPassword($user->Password);
            $user->generateAuthKey();
			$user->generatePasswordResetToken();
			$user->Created=date('Y-m-d');
			$user->IsVerified=1;
			$user->Enabled=1;
			$user->IdPriv=11;//wali siswa
			
			$model->MemberId=$member->MemberId;
					
			
			if($member->save() && $user->save(false) ){
				$model->save();
				
				return $this->redirect(['view', 'id' => $model->Id]);
			}	
			else {
				return $this->render('register', [
					'model' => $model,
					'member' => $member,
					'user' => $user,
				]);
			}
				
		}
		else
		{
			
			return $this->render('register', [
				'model' => $model,
				'user' => $user,
				'member' => $member,
			]);
		}
	}
}
