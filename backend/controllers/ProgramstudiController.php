<?php

namespace backend\controllers;

use Yii;
use common\models\ProgramStudi;
use common\models\ProgramStudiSearch;
use common\models\Kompetensi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramstudiController implements the CRUD actions for ProgramStudi model.
 */
class ProgramstudiController extends Controller
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
     * Lists all ProgramStudi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProgramStudiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProgramStudi model.
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
        $model = new ProgramStudi();

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
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model=$this->findModel($id);
		if(Kompetensi::find()->where(['IdProdi' => $id])->count() > 0){
			return $this->render('/site/prefenddelete',['data' => $model->ProgramStudi]);
		}
		else{
			$model->delete();
			return $this->redirect(['index']);
		}
    }

    protected function findModel($id)
    {
        if (($model = ProgramStudi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
