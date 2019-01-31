<?php

namespace backend\controllers;

use Yii;
use common\models\Kelas;
use common\models\KelasSearch;
use common\models\Siswa;
use common\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KelasController implements the CRUD actions for Kelas model.
 */
class KelasController extends Controller
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
        $searchModel = new KelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model=$this->findModel($id);
		$searchModel = new SiswaSearch(['KodeKelas' => $model->Kode]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('view', [
            'model' => $model,
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Kelas();

        if($model->load(Yii::$app->request->post())){
			if($model->IdKom == null){$model->IdKom =0;}
			
			if($model->save()){
				return $this->redirect(['index']);
			}
			else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
			
		}
		else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
			if($model->IdKom == null){$model->IdKom =0;}
			
			if($model->save()){
				return $this->redirect(['index']);
			}
			else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
			
		}
		else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Kelas model.
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
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
