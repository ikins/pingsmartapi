<?php

namespace backend\controllers;

use Yii;
use common\models\GaleryAlbum;
use common\models\GaleriAlbumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GaleryalbumController implements the CRUD actions for GaleryAlbum model.
 */
class GaleryalbumController extends Controller
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
     * Lists all GaleryAlbum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GaleriAlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GaleryAlbum model.
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
         $model = new GaleryAlbum();

        if($model->load(Yii::$app->request->post())){
			
			$image=UploadedFile::getInstance($model,'Cover');
			if (!$image == null) {
				$model->Cover=$image->name;
				$path = Yii::$app->params['imagePath'] .'/galery/cover/'.$model->Cover;
				$image->saveAs($path);
			}
			else{
				$model->Cover='';
			}
			
			if( $model->save()){

                return $this->redirect(['index']);
				
            } else {
               return $this->render('create', ['model' => $model,]);
            }
			
		}
		else{
			return $this->render('create', ['model' => $model,]);
		}
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
			 
			$image=UploadedFile::getInstance($model,'Cover');
			
			if (!$image == null) {
				$model->Cover=$image->name;
				$path = Yii::$app->params['imagePath'] .'/galery/cover/'.$model->Cover;
				$image->saveAs($path);
				}
			else{
				$model->Cover=$model::findOne($model->Id)->Cover;
			}
			 
			
			if( $model->save()){
                
                 return $this->redirect(['index']);
            } else {
                return $this->render('create', ['model' => $model,]);
            }
		}
		else{
			return $this->render('create', ['model' => $model,]);
		}
    }

    /**
     * Deletes an existing GaleryAlbum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GaleryAlbum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GaleryAlbum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GaleryAlbum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
