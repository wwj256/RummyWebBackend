<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserMailInfo;

/**
 * UserMailInfoSearch represents the model behind the search form of `backend\models\UserMailInfo`.
 */
class UserMailInfoSearch extends UserMailInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'SysID', 'UserID', 'Status'], 'integer'],
            [['Title', 'Content', 'SendTime', 'ExpireTime'], 'safe'],
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
        $query = UserMailInfo::find();

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
            'SysID' => $this->SysID,
            'UserID' => $this->UserID,
            'Status' => $this->Status,
            'SendTime' => $this->SendTime,
            'ExpireTime' => $this->ExpireTime,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'Content', $this->Content]);

        return $dataProvider;
    }
}
