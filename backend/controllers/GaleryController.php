<?php

namespace backend\controllers;

use Yii;
use common\models\Galery;
use common\models\GalerySearch;
use common\models\GaleryAlbum;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\data\Pagination;
/**
 * GaleryController implements the CRUD actions for Galery model.
 */
class GaleryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Galery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Galery::find();
		$pagination = new Pagination([
            'defaultPageSize' => 24,
            'totalCount' => $query->count(),
        ]);
		
		$pics = $query->orderBy(['Id' => SORT_DESC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
		return $this->render('index',[
			'pics' => $pics,
			'pagination' => $pagination,
		]);
    }

    /**
     * Displays a single Galery model.
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
        
		ini_set('memory_limit', '128M');
		$model = new Galery();

        if($model->load(Yii::$app->request->post())){
			
			$image=UploadedFile::getInstance($model,'Image');
			if (!$image == null) {
				$model->Image=$image->name;
				$path = Yii::$app->params['imagePath'] .'/galery/'.$model->Image;
				
				//create thumbnail
				if($image->saveAs($path)){
					Image::thumbnail($path, 360, 180)->save(Yii::getAlias(Yii::$app->params['imagePath'] .'/galery/thumbnail/'.$model->Image), ['quality' => 80]);
					$album=GaleryAlbum::find()->where(['Id' => $model->IdAlb])->one();
					$model->MemberId=$album->MemberId;
					if( $model->save()){return $this->redirect(['index']);} else {return $this->render('create', ['model' => $model,]);}
				}
				else{
					return $this->render('create', ['model' => $model,]);
				}
				
				
			}
			else{
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
		$imgold=Yii::$app->params['imagePath'] .'/galery/'.$model->Image;
		$tbold=Yii::$app->params['imagePath'] .'/galery/thumbnail/'.$model->Image;
		

        if($model->load(Yii::$app->request->post())){
			 
			$image=UploadedFile::getInstance($model,'Image');
			
			if (!$image == null) {
				$model->Image=$image->name;
				$path = Yii::$app->params['imagePath'] .'/galery/'.$model->Image;
				
				//create thumbnail
				if($image->saveAs($path)){
					Image::thumbnail($path, 360, 180)->save(Yii::getAlias(Yii::$app->params['imagePath'] .'/galery/thumbnail/'.$model->Image), ['quality' => 80]);
					unlink($imgold);
					unlink($tbold);
				}
				
				}
			else{
				$model->Image=$model::findOne($model->Id)->Image;
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

	public function actionBann($id)
    {
        $model=$this->findModel($id);
				
		if($model->load(Yii::$app->request->post())){
			$model->IdStat=4;
			$model->ModID=Yii::$app->user->identity->MemberId;
			
			if($model->save()){
				return $this->redirect(['index']);
			}
			else{
				return $this->render('bann',['model' => $model]);
			}
		}
		else{
			return $this->render('bann',['model' => $model]);
		}
		
		
		
		
	}
	
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
		$imgold=Yii::$app->params['imagePath'] .'/galery/'.$model->Image;
		$tbold=Yii::$app->params['imagePath'] .'/galery/thumbnail/'.$model->Image;
		
		if($model->delete()){
			unlink($imgold);
					unlink($tbold);
		}
		
        return $this->redirect(['index']);
    }

   protected function findModel($id)
    {
        if (($model = Galery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionAlbum($id)
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
		
		return $this->render('index',[
			'pics' => $pics,
			'pagination' => $pagination,
		]);
    }

}
