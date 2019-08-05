<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cust;

class Custs extends Cust
{
    
    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['id', 'fullname'], 'safe'],
        ];
    }
    
    public function search($params)
    {
        $query = Cust::find()->where(['status' => self::STATUS_ACTIVE]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => FALSE
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname]);

        return $dataProvider;
    }
}
