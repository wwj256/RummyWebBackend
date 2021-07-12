<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LogAdminTrade;

/**
 * LogAdminTradeSearch represents the model behind the search form of `common\models\LogAdminTrade`.
 */
class LogAdminTradeSearch extends LogAdminTrade
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'UserID', 'Score', 'SChange', 'AdminID'], 'integer'],
            [['UpdateTime'], 'safe'],
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
        $query = LogAdminTrade::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->id,
            'UserID' => $this->UserID,
            'Score' => $this->Score,
            'SChange' => $this->SChange,
            'AdminID' => $this->AdminID,
            'UpdateTime' => $this->UpdateTime,
        ]);

        return $dataProvider;
    }
}
