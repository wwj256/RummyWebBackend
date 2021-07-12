<?php

namespace merchantBackend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use merchantBackend\models\LogDeal;

/**
 * LogDealSearch represents the model behind the search form of `merchantBackend\models\LogDeal`.
 */
class LogDealSearch extends LogDeal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'UserID', 'Type', 'Score', 'DealScore', 'TargetID'], 'integer'],
            [['TargetPhone', 'UpdateTime'], 'safe'],
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
        $query = LogDeal::find();

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
        $uid = \Yii::$app->user->identity->getId();

        $query->andFilterWhere([
            'ID' => $this->ID,
            'UserID' => $uid,
            'Type' => $this->Type,
            'Score' => $this->Score,
            'DealScore' => $this->DealScore,
            'TargetID' => $this->TargetID,
            'SUBSTRING(UpdateTime,1,10)' => $this->UpdateTime,
        ]);

        $query->andFilterWhere(['like', 'TargetPhone', $this->TargetPhone]);

        return $dataProvider;
    }
}
