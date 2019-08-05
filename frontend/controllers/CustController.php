<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use common\models\User;
use common\models\Cust;
use common\models\Currency;

use frontend\models\Custs;

class CustController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
        $searchModel = new Custs();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAdd(){
        $model = new Cust();
        
        if ($model->load(Yii::$app->request->post())) {
            if(!$model->save()){
                \Yii::$app->session->setFlash('error', "Data gagal disimpan!");
            }else{
                \Yii::$app->session->setFlash('success', "Data berhasil disimpan!");
            }
        }
        
        return $this->render('form', [
            'model' => $model,
            'terms' => Cust::$terms,
            'cur' => ArrayHelper::map(Currency::findAll(['status' => Currency::STATUS_ACTIVE]), 'code', 'name')
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            if(!$model->save()){
                \Yii::$app->session->setFlash('error', "Data gagal disimpan!");
            }else{
                \Yii::$app->session->setFlash('success', "Data berhasil disimpan!");
            }
        }
        
        return $this->render('form', [
            'model' => $model,
            'terms' => Cust::$terms,
            'cur' => ArrayHelper::map(Currency::findAll(['status' => Currency::STATUS_ACTIVE]), 'code', 'name')
        ]);
    }

    public function actionView($id){
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    public function actionDelete($id)
    {
            
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED;

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($model->save()){
            Yii::$app->session->setFlash('success', 'Data berhasil disuspend.');
            return $this->redirect(['index']);
        }
    }
    

    protected function findModel($id)
    {
        if (($model = Cust::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
