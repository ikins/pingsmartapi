<?php

namespace backend\controllers;

use Yii;
use common\models\Nilai;
use common\models\NilaiSearch;
use common\models\NilaiDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NilaiController implements the CRUD actions for Nilai model.
 */
class NilaiController extends Controller
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
     * Lists all Nilai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NilaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nilai model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
		return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Nilai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nilai();

        if($model->load(Yii::$app->request->post())){
			$model->genKode($model->IdJenis);
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->Id]);
			}
			else{
				return $this->render('create', [
					'model' => $model,
				]);
			}
			
		}
		else{
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
        if (($model = Nilai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionAddDetail()
	{
		if(isset($_POST['NIS'])){
			
			$model=new NilaiDetail;
			$model->NIS=$_POST['NIS'];
			$model->Kode=$_POST['Kode'];
			$model->Nilai=$_POST['Nilai'];
			$model->KodePel=$_POST['KodePel'];
			$model->IdStat=$_POST['IdStat'];
			if($model->save()){
				
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
	
	public function actionRemoveDetail()
	{
		if(isset($_POST['id'])){
			$model=NilaiDetail::find()->where(['Id' => $_POST['id']])->one();
			if($model->delete()){
				
				return '{"Status":1,"Keterangan":"Berhasil Hapus Data"}';	
			}
			else{
				return '{"Status":2,"Keterangan":"Gagal"}';	
			}
		}
		else{
			return '{"Status":3,"Keterangan":"No Data"}';
		}
	}
	
}
