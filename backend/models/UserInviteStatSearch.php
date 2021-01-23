<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserInviteStat;

/**
 * UserInviteStatSearch represents the model behind the search form of `backend\models\UserInviteStat`.
 */
class UserInviteStatSearch extends UserInviteStat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UID', 'TotalBonus', 'InviteBonus', 'DepositBonus'], 'integer'],
            [['DayStat'], 'safe'],
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
        $query = UserInviteStat::find();

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
            'UID' => $this->UID,
            'DayStat' => $this->DayStat,
            'TotalBonus' => $this->TotalBonus,
            'InviteBonus' => $this->InviteBonus,
            'DepositBonus' => $this->DepositBonus,
        ]);

        return $dataProvider;
    }
}
