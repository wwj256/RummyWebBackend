<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserInviteLog;

/**
 * UserInviteLogSearch represents the model behind the search form of `backend\models\UserInviteLog`.
 */
class UserInviteLogSearch extends UserInviteLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'UserID', 'InviteUID', 'RelateID', 'OutBonus'], 'integer'],
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
        $query = UserInviteLog::find();

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
            'ID' => $this->ID,
            'UserID' => $this->UserID,
            'InviteUID' => $this->InviteUID,
            'RelateID' => $this->RelateID,
            'OutBonus' => $this->OutBonus,
            'UpdateTime' => $this->UpdateTime,
        ]);

        return $dataProvider;
    }
}
