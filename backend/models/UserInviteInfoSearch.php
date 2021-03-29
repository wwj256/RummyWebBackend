<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserInviteInfo;

/**
 * UserInviteInfoSearch represents the model behind the search form of `backend\models\UserInviteInfo`.
 */
class UserInviteInfoSearch extends UserInviteInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserID', 'MyInviter', 'InviteCounts', 'TotalBonus', 'InviteBonus', 'DepositBonus', 'TodayOutBonus', 'TotalOutBonus'], 'integer'],
            [['RecordTime'], 'safe'],
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
        $query = UserInviteInfo::find();

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
            'MyInviter' => $this->MyInviter,
            'InviteCounts' => $this->InviteCounts,
            'TotalBonus' => $this->TotalBonus,
            'InviteBonus' => $this->InviteBonus,
            'DepositBonus' => $this->DepositBonus,
            'TodayOutBonus' => $this->TodayOutBonus,
            'TotalOutBonus' => $this->TotalOutBonus,
            'RecordTime' => $this->RecordTime,
        ]);

        return $dataProvider;
    }
}
