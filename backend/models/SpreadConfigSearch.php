<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SpreadConfig;

/**
 * SpreadConfigSearch represents the model behind the search form of `backend\models\SpreadConfig`.
 */
class SpreadConfigSearch extends SpreadConfig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'SpreadID', 'UpdateMode'], 'integer'],
            [['RegVersion', 'ApkUrl', 'HotUrl', 'PageUrl', 'Notice', 'CurVersion', 'ApkVersion', 'PacketUrl'], 'safe'],
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
        $query = SpreadConfig::find();

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
            'SpreadID' => $this->SpreadID,
            'UpdateMode' => $this->UpdateMode,
        ]);

        $query->andFilterWhere(['like', 'RegVersion', $this->RegVersion])
            ->andFilterWhere(['like', 'ApkUrl', $this->ApkUrl])
            ->andFilterWhere(['like', 'HotUrl', $this->HotUrl])
            ->andFilterWhere(['like', 'PageUrl', $this->PageUrl])
            ->andFilterWhere(['like', 'Notice', $this->Notice])
            ->andFilterWhere(['like', 'CurVersion', $this->CurVersion])
            ->andFilterWhere(['like', 'ApkVersion', $this->ApkVersion])
            ->andFilterWhere(['like', 'PacketUrl', $this->PacketUrl]);

        return $dataProvider;
    }
}
