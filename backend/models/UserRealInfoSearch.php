<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserRealInfo;

/**
 * UserRealInfoSearch represents the model behind the search form of `backend\models\UserRealInfo`.
 */
class UserRealInfoSearch extends UserRealInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserID', 'Type', 'Status'], 'integer'],
            [['FrontUrl', 'BackUrl', 'Name', 'CardID', 'Birth', 'Address', 'RecordTime'], 'safe'],
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
        $query = UserRealInfo::find();

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
            'Type' => $this->Type,
            'Status' => $this->Status,
            'RecordTime' => $this->RecordTime,
        ]);

        $query->andFilterWhere(['like', 'FrontUrl', $this->FrontUrl])
            ->andFilterWhere(['like', 'BackUrl', $this->BackUrl])
            ->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'CardID', $this->CardID])
            ->andFilterWhere(['like', 'Birth', $this->Birth])
            ->andFilterWhere(['like', 'Address', $this->Address]);

        return $dataProvider;
    }
}
