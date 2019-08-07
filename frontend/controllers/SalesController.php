<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\helpers\ArrayHelper;

use common\models\Catalog;
use common\models\Order;
use common\models\OrderItems;
use common\models\Cust;

use common\models\SequenceOrder;

use frontend\models\Sales;

class SalesController extends Controller
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
        $searchModel = new Sales();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionDo()
    {
        $searchModel = new Sales();
        $dataProvider = $searchModel->searchDo(Yii::$app->request->queryParams);
        
        return $this->render('do', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionAdd(){
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {
            
        }else{
            $model->inv_no = $this->addSequence();
        }
        
        return $this->render('form-inv', [
            'model' => $model,
            'terms' => Cust::$terms,
            'customers' => ArrayHelper::map(Cust::findAll(['status' => Cust::STATUS_ACTIVE]), 'id', 'fullname')
        ]);
    }
    
    private function addSequence(){
        $model = new SequenceOrder();
        if($model->save()){
            return 'INVH-' . str_pad((string)$model->no, 4, "0", STR_PAD_LEFT);
             
        }
        
        return 'INVH-0000';
    }
    
    public function actionUpdateQty($id){
        $prod = $this->findModel($id);
        $model = new OrderItems();
        $act = (Yii::$app->request->get('act') && Yii::$app->request->get('act') === 'd' ? 'd' : 'i');
        
        if ($model->load(Yii::$app->request->post())) {
            $model->catalog_id=$id;
            $model->qty = ($act === 'd' ? (-$model->qty) : $model->qty);
            $model->type=$act;
            if(!$model->save()){
                \Yii::$app->session->setFlash('error', "Data gagal disimpan!");
            }else{
                \Yii::$app->session->setFlash('success', "Data berhasil disimpan!");
            }
        }
        
        return $this->render('form-update-qty', [
            'prod' => $prod,
            'model' => $model,
            'act' => $act
        ]);
    }
    
    private function addNewItem($catalog_id, $qty, $type='i'){
        $orderItem = new OrderItems();
        
        $orderItem->catalog_id = $catalog_id;
        $orderItem->qty = $qty;
        $orderItem->type = $type;
        
        return $orderItem->save();
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
            'type' => Catalog::$type
        ]);
    }

    public function actionHistory()
    {
        $searchModel = new \frontend\models\History();
        if(Yii::$app->request->get('name')){
            $searchModel->name = Yii::$app->request->get('name');
        }
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('history', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type' => OrderItems::TYPES
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
        if (($model = Catalog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
