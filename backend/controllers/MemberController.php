<?php

namespace backend\controllers;

use Yii;
use common\models\Member;
use common\models\MemberSearch;
use common\models\MemberRecord;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
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
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
public function actionProfile()
    {
        $model=Member::find()->where(['Id' => Yii::$app->user->identity->member->Id ])->one();
       return $this->render('profile', [
            'model' => $model,
        ]);
    }
     public function actionUpdate($id)
    {
        $model=Member::find()->where(['Id' => Yii::$app->user->identity->member->Id ])->one();
		if($model->load(Yii::$app->request->post())){
			
			$image=UploadedFile::getInstance($model,'Avatar');
			if (!$image == null) {
				$model->Avatar=$image->name;
				$path = Yii::$app->params['imagePath'] .'/user/'.$model->Avatar; 
				$image->saveAs($path);
			}
			else{
				$model->Avatar = $model::findOne($model->Id)->Avatar;
			}
			
			if ($model->save()){
				return $this->redirect(['view', 'id' => $model->Id]);
			}
			else{
				
				return $this->render('update', [
					'model' => $model,
				]);
			}
			
		}
		else{
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

    /**
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionPlanActivate($id)
    {
        $member=$this->findModel($id);
		$model=new MemberRecord;
		$model->MemberId=$member->MemberId;
		
		if($model->load(Yii::$app->request->post())){
			
			$model->Tanggal=date('Y-m-d');
			$model->Durasi=$model->plan->Durasi;
			$model->Harga=$model->plan->Harga;
			$model->Expired=date('Y-m-d',strtotime("+".$model->plan->Durasi." days", strtotime($model->Tanggal)));
			
			$member->ExpiredDate=$model->Expired;
			$member->GracePeriode=date('Y-m-d',strtotime("+7 days", strtotime($model->Expired)));
			$member->KodePlan=$model->plan->Kode;
			if($member->IdStat !== 6){$member->IdStat=3;}
			
			if($model->save()){
				$member->save();
				$member->CountRemain($id);
				return $this->redirect(['view', 'id' => $id]);
			}
			else{
				return $this->render('planactivate', [
					'model' => $model,
				]);
			}
			
		}
		else{
			return $this->render('planactivate', [
                'model' => $model,
            ]);
		}
		
    }
	
	public function actionBlock($id)
    {
        $model=$this->findModel($id);
		$model->IdStat=6;
		$user=User::find()->where(['MemberId' => $model->MemberId])->one();
		$user->Enabled=0;
		if($model->save()){
			$user->save();
		}

        return $this->redirect(['index']);
    }
	
	public function actionUnblock($id)
    {
        $model=$this->findModel($id);
		$model->IdStat=3;
		$user=User::find()->where(['MemberId' => $model->MemberId])->one();
		$user->Enabled=1;
		if($model->save()){
			$user->save();
		}

        return $this->redirect(['index']);
    }

	public function actionBlocked(){
        $searchModel = new MemberSearch(['IdStat' => 6]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('blocked', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

