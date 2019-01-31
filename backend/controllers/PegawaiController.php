<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use common\models\Pegawai;
use common\models\PegawaiBiodata;
use common\models\PegawaiSearch;
use common\models\User;
use common\models\Member;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class PegawaiController extends Controller
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

    /**
     * Lists all Pegawai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pegawai model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Pegawai();
		$data =new PegawaiBiodata();
		$user =new User();
		$member =new Member;

         if ($model->load(Yii::$app->request->post()) 
			&& $data->load(Yii::$app->request->post())
		    && $user->load(Yii::$app->request->post())
			&& Model::validateMultiple([$model,$data,$user])) {
				
			$image=UploadedFile::getInstance($data,'Foto');
			if (!$image == null) {
				$data->Foto=$image->name;
				$member->Avatar=$image->name;
				
				$path = Yii::$app->params['imagePath'] .'/user/'.$member->Avatar;
				$path2 = Yii::$app->params['imagePath'] .'/guru/'.$member->Avatar;
				$image->saveAs($path);
				$image->saveAs($path2);
			}
			else{
				$data->Foto='dummy.png';
				$member->Avatar='dummy.png';
			}
			
			/** generate kode member ***/
			$member->Nama=$data->Nama;
			$member->GenKode();
			$member->IdStat=2;//registered
			$member->IdLev=4;//guru
			
			$user->MemberId=$member->MemberId;
			$user->setPassword($user->Password);
            $user->generateAuthKey();
			$user->generatePasswordResetToken();
			$user->Created=date('Y-m-d');
			$user->IsVerified=1;
			$user->Enabled=1;
			$user->IdPriv=10;//guru
			
			$model->genKode();
			$model->MemberId=$member->MemberId;
			$data->IdPeg=$model->IdPeg;
			if($member->save() && $user->save(false) ){
				$model->save();
				$data->save();
				return $this->redirect(['view', 'id' => $model->Id]);
			}	
			else {
				return $this->render('create', [
					'model' => $model,
					'data' => $data,
					'member' => $member,
					'user' => $user,
				]);
			}
				
           
        } else {
            return $this->render('create', [
                'model' => $model,
				'data' => $data,
				'user' => $user,
				'member' => $member,
            ]);
        }
    }

    
	public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$data =PegawaiBiodata::find()->where(['IdPeg' => $model->IdPeg])->one();
		$user =User::find()->where(['MemberId' => $model->MemberId])->one();
		$member =Member::find()->where(['MemberId' => $model->MemberId])->one();

        if ($model->load(Yii::$app->request->post()) 
			&& $data->load(Yii::$app->request->post())
		    && Model::validateMultiple([$model,$data,$user])) {
				
			$image=UploadedFile::getInstance($data,'Foto');
			if (!$image == null) {
				$data->Foto=$image->name;
				$member->Avatar=$image->name;
				
				$path = Yii::$app->params['imagePath'] .'/user/'.$member->Avatar;
				$path2 = Yii::$app->params['imagePath'] .'/guru/'.$member->Avatar;
				$image->saveAs($path);
				$image->saveAs($path2);
			}
			else{
				$data->Foto=PegawaiBiodata::find()->where(['IdPeg' => $model->IdPeg])->one()->Foto;
				$member->Avatar=Member::find()->where(['MemberId' => $model->MemberId])->one()->Avatar;
			}
			
			$member->Nama=$data->Nama;
						
			$user->MemberId=$member->MemberId;
			            						
			if($member->save() && $user->save(false) ){
				$model->save();
				$data->save();
				return $this->redirect(['view', 'id' => $model->Id]);
			}	
			else {
				return $this->render('update', [
					'model' => $model,
					'data' => $data,
					'member' => $member,
					'user' => $user,
				]);
			}
				
           
        } else {
            return $this->render('update', [
                'model' => $model,
				'data' => $data,
				'user' => $user,
				'member' => $member,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model=$this->findModel($id);
		$member=Member::find()->where(['MemberId' => $model->MemberId])->one()->delete();
        return $this->redirect(['index']);
    }

   protected function findModel($id)
    {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionChecknip(){
		if($_POST['nip'] !== ''){
			$model=Pegawai::find()->where(['NIP' => $_POST['nip']])->one();
			if($model == null){return 0;}else{return 1;}  
		}
	}
}
