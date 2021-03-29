<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ActivityInfo;

/**
 * ActivityInfoSearch represents the model behind the search form of `backend\models\ActivityInfo`.
 */
class ActivityInfoSearch extends ActivityInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['Tiltle', 'Url', 'JumpTo', 'StartTime', 'EndTime'], 'safe'],
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
        $query = ActivityInfo::find();

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
            'JumpTo' => $this->JumpTo,
            'StartTime' => $this->StartTime,
            'EndTime' => $this->EndTime,
        ]);

        $query->andFilterWhere(['like', 'Tiltle', $this->Tiltle])
            ->andFilterWhere(['like', 'Url', $this->Url]);

        return $dataProvider;
    }
}
