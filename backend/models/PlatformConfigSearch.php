<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PlatformConfig;

/**
 * PlatformConfigSearch represents the model behind the search form of `backend\models\PlatformConfig`.
 */
class PlatformConfigSearch extends PlatformConfig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['K', 'V', 'info'], 'safe'],
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
        $query = PlatformConfig::find();

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
        $query->andFilterWhere(['like', 'K', $this->K])
            ->andFilterWhere(['like', 'V', $this->V])
            ->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
