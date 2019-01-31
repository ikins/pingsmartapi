<?php

namespace backend\controllers;

use Yii;
use common\models\Payment;
use common\models\Member;
use common\models\MemberAccount;

use common\models\PaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class PaymentController extends Controller
{
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete','validate' => ['POST'],
                ],
            ],
        ];
    }

   
    public function actionIndex()
    {
        $searchModel = new PaymentSearch(['IdStat' => 1]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionReceived()
    {
        $searchModel = new PaymentSearch(['IdStat' => 2]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('received', [
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

    
    public function actionCreate()
    {
        $model = new Payment();

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
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionValidate($id)
    {
        
		$model=Payment::findOne($id);
		$model->IdStat=2;
		
		$member=Member::find()->where(['MemberId' => $model->MemberId])->one();
		
		$account=new MemberAccount();
		
		$account->MemberId=$member->MemberId;
		$account->Tanggal=date('Y-m-d');
		$account->Jumlah=$model->Jumlah;
		$account->SaldoAwal=$member->TotalBalance;
		
		//bila deposit awal
		switch ($model->IdType){
			
			case 1: //deposit awal
				
				$member->HajjBalance=$member->level->HajjBalance;
				$member->UmrahBalance=$member->level->UmrahBalance;
				$member->DepositBalance=($model->Jumlah) - ($member->HajjBalance) - ($member->UmrahBalance);
				$member->TotalBalance=$member->TotalBalance + $model->Jumlah;
				$member->IdStat=3;
				
				$account->IdType=1;
				$account->Deskripsi='Saldo Awal';
				$account->Penambahan=$model->Jumlah;
				$account->Pengurangan=0;
				
				break;
				
			case 2: //penambahan deposit
				
				
				$member->DepositBalance=$member->DepositBalance + $model->Jumlah;
				$account->IdType=1;
				$account->Deskripsi='Tambah Saldo';
				$account->Penambahan=$model->Jumlah;
				$account->Pengurangan=0;
				
				break;
				
		}
		
				
		$account->SaldoAkhir= $account->SaldoAwal + $account->Penambahan - $account->Pengurangan;
		
		if($model->save()){
			if ($member->save()){$member->sumDeposit($member->MemberId);}
			
			$account->save(false);
			return $this->redirect(['index']);
		}
		else{
			return 'gagal';
		}

		

       
    }
}
