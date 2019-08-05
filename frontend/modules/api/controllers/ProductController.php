<?php

namespace frontend\modules\api\controllers;

use Yii;
use common\models\Product;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ProductController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
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
        ];
    }
    
    public function actionIndex(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $q = Product::find();
        if(Yii::$app->request->get('q') || Yii::$app->request->get('q') === ''){
            $q->andWhere(['like', 'name', Yii::$app->request->get('q')]);
        }
        
        $rows = $q->orderBy('name')->all();
        
        $resultSet = [];
        if(!empty($rows)){
            foreach ($rows as $row) {
                $resultSet[] = [
                    'id' => $row->id,
                    'text' => '<span style="font-size:0.85em;">' . $row->name . '</span>',
                ];
            }
        }
        
        return $resultSet;
    }
    
}
