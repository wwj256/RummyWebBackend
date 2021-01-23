<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GameRoom;

/**
 * GameRoomSearch represents the model behind the search form of `backend\models\GameRoom`.
 */
class GameRoomSearch extends GameRoom
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['GameID', 'RealGameID', 'HaveRbt', 'ActivPlayer', 'RoomStatus', 'MainSrvId', 'SubSrvId'], 'integer'],
            [['ConfJson', 'UpdateTime'], 'safe'],
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
        $query = GameRoom::find();

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
            'RoomID' => $this->RoomID,
            'GameID' => $this->GameID,
            'RoomStatus' => $this->RoomStatus,
            'MainSrvId' => $this->MainSrvId,
            'SubSrvId' => $this->SubSrvId,
            'UpdateTime' => $this->UpdateTime,
        ]);

        $query->andFilterWhere(['like', 'ConfJson', $this->ConfJson]);

        return $dataProvider;
    }
}
