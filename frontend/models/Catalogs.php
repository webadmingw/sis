<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Catalog;

/**
 * Catalogs represents the model behind the search form of `common\models\Catalog`.
 */
class Catalogs extends Catalog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'type', 'desc', 'unit', 'merk', 'loc_code'], 'safe'],
            [['cost', 'min_price'], 'number'],
            [['status', 'category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Catalog::find()->where(['status' => self::STATUS_ACTIVE]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cost' => $this->cost,
            'min_price' => $this->min_price,
            'status' => $this->status,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'merk', $this->merk])
            ->andFilterWhere(['like', 'loc_code', $this->loc_code]);

        return $dataProvider;
    }
}
