<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserActionStat;

/**
 * UserActionStatSearch represents the model behind the search form of `backend\models\UserActionStat`.
 */
class UserActionStatSearch extends UserActionStat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UniqueID'], 'safe'],
            [['UID', 'Loading', 'Lobby', 'NewGuide', 'FinishGuide', 'EnterPractise', 'EnterGold', 'FinishGame', 'BrakeUp', 'BrakeOpenPayWeb', 'BrakeOpenActivity', 'OpenDraw', 'OpenVip', 'OpenShare', 'NetBrake'], 'integer'],
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
        $query = UserActionStat::find();

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
            'Loading' => $this->Loading,
            'Lobby' => $this->Lobby,
            'NewGuide' => $this->NewGuide,
            'FinishGuide' => $this->FinishGuide,
            'EnterPractise' => $this->EnterPractise,
            'EnterGold' => $this->EnterGold,
            'FinishGame' => $this->FinishGame,
            'BrakeUp' => $this->BrakeUp,
            'BrakeOpenPayWeb' => $this->BrakeOpenPayWeb,
            'BrakeOpenActivity' => $this->BrakeOpenActivity,
            'OpenDraw' => $this->OpenDraw,
            'OpenVip' => $this->OpenVip,
            'OpenShare' => $this->OpenShare,
            'NetBrake' => $this->NetBrake,
        ]);

        $query->andFilterWhere(['like', 'UniqueID', $this->UniqueID]);

        return $dataProvider;
    }
}
