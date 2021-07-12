<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserDeal;

/**
 * UserDealSearch represents the model behind the search form of `backend\models\UserDeal`.
 */
class UserDealSearch extends UserDeal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserID', 'Score'], 'integer'],
            [['Password', 'Phone', 'CreateDate'], 'safe'],
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
        $query = UserDeal::find();

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
            'UserID' => $this->UserID,
            'Score' => $this->Score,
            'CreateDate' => $this->CreateDate,
        ]);

        $query->andFilterWhere(['like', 'Password', $this->Password])
            ->andFilterWhere(['like', 'Phone', $this->Phone]);

        return $dataProvider;
    }
}
