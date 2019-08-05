<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;
use common\models\Cust;


class Sales extends Order
{
    public $start_date;
    public $end_date;
    
    public function rules()
    {
        return [
            [['id', 'delivery_no', 'sales_id', 'created_by', 'status'], 'integer'],
            [['start_date', 'end_date', 'po_no', 'delivery_date', 'inv_no', 'inv_date', 'cust_id', 'terms', 'courier', 'memo'], 'safe'],
            [['discount', 'freight'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Order::find()
                ->joinWith(['cust'])
                ->where(['delivery_no' => ''])->orWhere(['is', 'delivery_no', null]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'delivery_no' => $this->delivery_no,
        ]);

        $query->andFilterWhere(['between', 'inv_date', $this->start_date, $this->end_date])
            ->andFilterWhere(['like', 'inv_no', $this->inv_no])
            ->andFilterWhere(['like', 'cust_id', $this->cust_id]);

        return $dataProvider;
    }
    
    public function searchDo($params)
    {
        $query = Order::find()
                ->joinWith(['cust'])->where(['inv_no' => '']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'inv_no' => '',
        ]);

        $query->andFilterWhere(['between', 'inv_date', $this->start_date, $this->end_date])
            ->andFilterWhere(['like', 'inv_no', $this->inv_no])
            ->andFilterWhere(['like', 'cust_id', $this->cust_id]);

        return $dataProvider;
    }
    
}
