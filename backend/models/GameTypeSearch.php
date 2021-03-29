<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GameType;

/**
 * GameTypeSearch represents the model behind the search form of `backend\models\GameType`.
 */
class GameTypeSearch extends GameType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['GameID'], 'integer'],
            [['GameName'], 'safe'],
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
        $query = GameType::find();

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
            'GameID' => $this->GameID,
        ]);

        $query->andFilterWhere(['like', 'GameName', $this->GameName]);

        return $dataProvider;
    }
}
