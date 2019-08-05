<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\models\SigninForm;
use frontend\models\User;

class SigninController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    if(!Yii::$app->user->isGuest){
                        return $this->redirect(\yii\helpers\Url::toRoute(['/']));
                    }
                },
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SigninForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){
                return $this->goBack();
            }
            Yii::$app->session->setFlash('error', $model->getFirstError('password'));
            $model->password = '';
        } 
        
        $this->layout = "sign-in";
        return $this->render('index', [
            'model' => $model,
        ]);
        
    }
    
}
