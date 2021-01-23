<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserClubInfo;

/**
 * UserClubInfoSearch represents the model behind the search form of `backend\models\UserClubInfo`.
 */
class UserClubInfoSearch extends UserClubInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserID', 'LoyalPoints', 'RedeemScore', 'Level', 'Counts', 'TotalScore'], 'integer'],
            [['RecordTime', 'UpdateTime'], 'safe'],
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
        $query = UserClubInfo::find();

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
            'LoyalPoints' => $this->LoyalPoints,
            'RedeemScore' => $this->RedeemScore,
            'Level' => $this->Level,
            'Counts' => $this->Counts,
            'TotalScore' => $this->TotalScore,
            'RecordTime' => $this->RecordTime,
            'UpdateTime' => $this->UpdateTime,
        ]);

        return $dataProvider;
    }
}
