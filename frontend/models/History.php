<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderItems;

class History extends OrderItems
{
    public $name;
    public $start_date;
    public $end_date;
    
    public function rules()
    {
        return [
            [['order_id', 'qty'], 'integer'],
            [['fix_price', 'disc', 'tax'], 'number'],
            [['created_date', 'name', 'start_date', 'end_date'], 'safe'],
            [['catalog_id'], 'string', 'max' => 7],
            [['note'], 'string', 'max' => 150],
            [['type'], 'string', 'max' => 1],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = OrderItems::find();
        $query->joinWith(['catalog']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        
        $query->andFilterWhere(['between', 'created_date', $this->start_date, $this->end_date])
            ->andFilterWhere(['like', 'catalog.name', $this->name]);
                

        return $dataProvider;
    }
    
    public static function getTotal($provider, $fieldName)
    {
        $total = 0;

        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }

        return $total;
    }
    
}
