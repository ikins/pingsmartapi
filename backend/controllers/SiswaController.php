<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use common\models\Siswa;
use common\models\SiswaBiodata;
use common\models\SiswaBiodataSearch;
use common\models\SiswaSearch;
use common\models\nilai;
use common\models\NilaiSearch;
use common\models\Member;
use common\models\User;
use common\models\Wali;
use common\models\SiswaWali;
use common\models\Galery;
use common\models\Kelas;
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

    /**
     * Lists all Siswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index-new', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
	public function actionView($id)
    {
        $model=$this->findModel($id);
		$galeri=Galery::find()->where(['MemberId' => $model->MemberId])->all();
		return $this->render('view', [
            'model' => $model,
			'galeri' => $galeri,
        ]);
    }

    
    public function actionCreate()
    {
        $model = new Siswa();
		$data = new SiswaBiodata();
		$member=new Member();
		$user = new user();

				
		 if ($model->load(Yii::$app->request->post()) 
			&& $data->load(Yii::$app->request->post())
		    && $user->load(Yii::$app->request->post())
			&& Model::validateMultiple([$model,$data,$user])) {
		 	//
			$kelas=Kelas::find()->where(['Kode' => $model->KodeKelas])->one();
			$jumlahSiswa=Siswa::find()->where(['KodeKelas' => $model->KodeKelas])->count();

			if($kelas->Jumlah != $jumlahSiswa){

				$image=UploadedFile::getInstance($data,'Foto');
				if (!$image == null) {
					$data->Foto=$image->name;
					$member->Avatar=$image->name;
					
					$path = Yii::$app->params['imagePath'] .'/user/'.$member->Avatar;
					$path2 = Yii::$app->params['imagePath'] .'/siswa/'.$member->Avatar;
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
				$member->IdLev=6;//siswa
				
				$user->MemberId=$member->MemberId;
				$user->setPassword($user->Password);
	            $user->generateAuthKey();
				$user->generatePasswordResetToken();
				$user->Created=date('Y-m-d');
				$user->IsVerified=1;
				$user->Enabled=1;
				$user->IdPriv=12;//siswa
				
				$model->MemberId=$member->MemberId;
				$data->NIS=$model->NIS;
				$model->IsActive=1;
				if($data->IdAgm == null){$data->IdAgm=1;}
				
				if($member->save() && $user->save(false) ){
					$model->save();
					$data->save();
					return $this->redirect(['index']);
					//return $this->redirect(['view', 'id' => $model->Id]);
				}	
				else {
					return $this->render('create', [
						'model' => $model,
						'data' => $data,
						'member' => $member,
						'user' => $user,
					]);
				}
			}else{
				
				Yii::$app->session->setFlash('flashMsg');
				return $this->render('create', [
						'model' => $model,
						'data' => $data,
						'member' => $member,
						'user' => $user,
					]);
			}
				
		}
        else {
            return $this->render('create', [
                'model' => $model,
				'data' => $data,
				'member' => $member,
				'user' => $user,
            ]);
        }
    }

    public function actionUpdate($id)
    {
		$model = Siswa::find()->where(['Id' => $id])->one();
		$data = SiswaBiodata::find()->where(['NIS' => $model->NIS])->one();
		$member=Member::find()->where(['MemberId' => $model->MemberId])->one();
		$user = User::find()->where(['MemberId' => $model->MemberId])->one();
		
		
		 if ($model->load(Yii::$app->request->post()) 
			&& $data->load(Yii::$app->request->post())
		    && $user->load(Yii::$app->request->post())
			&& Model::validateMultiple([$model,$data])) {
				
			$image=UploadedFile::getInstance($data,'Foto');
			if (!$image == null) {
				$data->Foto=$image->name;
				$member->Avatar=$image->name;
				
				$path = Yii::$app->params['imagePath'] .'/user/'.$member->Avatar;
				$path2 = Yii::$app->params['imagePath'] .'/siswa/'.$member->Avatar;
				$image->saveAs($path);
				$image->saveAs($path2);
			}
			else{
				$data->Foto=SiswaBiodata::find()->where(['NIS' => $model->NIS])->one()->Foto;
				//$member->Avatar=Siswa::find()->where(['Id' => $id])->one()->Avatar;
			}
			
			// Update 12 Feb 2019 by Ikin
			/** generate kode member ***/
			//$member->Nama=$data->Nama;
			//$member->GenKode();
			//$member->IdStat=2;//registered
			//$member->IdLev=6;//siswa
			
			$user->Created=date('Y-m-d');
			$user->IsVerified=1;
			$user->Enabled=1;
			$user->IdPriv=12;//siswa
			
			//$model->MemberId=$member->MemberId;
			$data->NIS=$model->NIS;
			$model->IsActive=1;
			
			
			if($member->save() && $user->save(false) ){
				$model->save();
				$data->save();
				//return $this->redirect(['index']);
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
				
		}
        else {
            return $this->render('update', [
                'model' => $model,
				'data' => $data,
				'member' => $member,
				'user' => $user,
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
        if (($model = Siswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionAddWali()
	{
		if(isset($_POST['nis'])){
			
			$model=new Wali;
			$sw=new SiswaWali;
			
			$model->Nama=$_POST['Nama'];
			$model->Alamat=$_POST['Alamat'];
			$model->IdProv=$_POST['IdProv'];
			$model->IdKab=$_POST['IdKab'];
			$model->Kota=$_POST['Kota'];
			$model->Pos=$_POST['Pos'];
			$model->Telepon=$_POST['Telepon'];
			$model->HP=$_POST['HP'];
			$model->IdJob=$_POST['IdJob'];
			$model->Keterangan=$_POST['Keterangan'];
			$model->genKode();
			if($model->save()){
				$sw=new SiswaWali;
				$sw->NIS=$_POST['nis'];
				$sw->KodeWali=$model->Kode;
				$sw->IdFam=$_POST['IdFam'];
				$sw->save();
				return '{"Status":1,"Keterangan":"Berhasil Simpan Data"}';	
			}
			else{
				return '{"Status":2,"Keterangan":"Gagal"}';	
			}
		}
		else{
			return '{"Status":3,"Keterangan":"No Data"}';
		}
	}
	
	public function actionFindByKelas($id)
	{
		$models=Siswa::find()->where(['KodeKelas' => $id])->all();
			echo "<option value=''>Pilih Siswa</option>";
		foreach($models as $k){
			echo "<option value='".$k->NIS."'>".$k->biodata->Nama."</option>";
		}
	}
	
	public function actionGaleri()
    {
        $query = Galery::find();
		$pagination = new Pagination([
            'defaultPageSize' => 24,
            'totalCount' => $query->count(),
        ]);
		
		$pics = $query->orderBy(['Judul' => SORT_ASC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
		return $this->render('galeri',[
			'pics' => $pics,
			'pagination' => $pagination,
		]);
    }
	
	public function actionGaleriview($id)
    {
        $query = Galery::find()->where(['IdAlb' => $id]);
		$pagination = new Pagination([
            'defaultPageSize' => 24,
            'totalCount' => $query->count(),
        ]);
		
		$pics = $query->orderBy(['Id' => SORT_DESC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
		return $this->render('galeri',[
			'pics' => $pics,
			'pagination' => $pagination,
		]);
    }
	
	public function actionProfil(){
		$query = Siswa::find();
		$pagination = new Pagination([
            'defaultPageSize' => 24,
            'totalCount' => $query->count(),
        ]);
		
		$models = $query->orderBy(['Id' => SORT_DESC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
		return $this->render('profil',[
			'models' => $models,
			'pagination' => $pagination,
		]);
	}
	
	public function actionNilai()
    {

         $query = Nilai::find();
		$pagination = new Pagination([
            'defaultPageSize' => 24,
            'totalCount' => $query->count(),
        ]);
		
		$pics = $query->orderBy(['Guru' => SORT_ASC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
        return $this->render('_nilai', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	/** check if nis is exists **/
	public function actionChecknis(){
		if($_POST['nis'] !== ''){
			$model=Siswa::find()->where(['NIS' => $_POST['nis']])->one();
			if($model == null){return 0;}else{return 1;}  
		}
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
