<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\base\Model;


use common\models\LProvince;
use common\models\LCity;
use common\models\LDistrict;
use common\models\User;
use common\models\Cust;

use frontend\models\Users;
use frontend\models\ChangePassword;

class UsersController extends Controller
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
        $searchModel = new Users();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAdd(){
        $model = new User();
        
        $model->setPassword('user123');
        $model->created_at = time();
        $model->updated_at = time();
        
        if ($model->load(Yii::$app->request->post())) {
            if(!$model->save()){
                \Yii::$app->session->setFlash('error', "Data gagal disimpan!");
            }else{
                \Yii::$app->session->setFlash('success', "Data berhasil disimpan!");
            }
        }
        
        return $this->render('form', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $detail = $model->detail;
        
        if ($model->load(Yii::$app->request->post()) && $detail->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $t = \Yii::$app->db->beginTransaction();
            if(Model::validateMultiple([$model, $detail]) && $model->save(false) && $model->addDetail($detail)){
                $t->commit();
                return ['status' => TRUE];
            }
            $t->rollBack();
            
            $errors = ['user' => $model->errors, 'cust' => $detail->errors];
            return ['status' => FALSE, 'errors' => $errors];
        }
        
        return $this->render('form', [
            'model' => $model,
            'detail' => $detail,
            'p' => ArrayHelper::map(LProvince::find()->orderBy('name')->all(), 'id', 'name'),
            'c' => ArrayHelper::map(LCity::find()->orderBy('name')->all(), 'id', 'name'),
            'd' => ArrayHelper::map(LDistrict::find()->orderBy('name')->limit(30)->all(), 'id', 'name'),
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
        if(\Yii::$app->user->id == $id){
            throw new ForbiddenHttpException('Tidak diizinkan menghapus diri sendiri.');
        }
            
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED;

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($model->save()){
            Yii::$app->session->setFlash('success', 'Data berhasil dihapus.');
            return $this->redirect(['index']);
        }
    }
    
    public function actionProfile(){
        $model = $this->findModel(Yii::$app->user->id);
        
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'Data berhasil disimpan.');
        }
        
        return $this->render('profile', [
            'model' => $model,
        ]);
    }
    
    public function actionChangePassword(){
        $model = new ChangePassword();
        
        if($model->load(Yii::$app->request->post())){
            if($model->change()){
                Yii::$app->session->setFlash('success', 'Kata kunci berhasil diganti.');
            }
        }
        
        return $this->render('change-password', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
