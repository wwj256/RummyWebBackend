<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserScoreChange;

/**
 * UserScoreChangeSearch represents the model behind the search form of `backend\models\UserScoreChange`.
 */
class UserScoreChangeSearch extends UserScoreChange
{
    public $create_time;
    public $end_time;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'UID', 'NewUser', 'SpreadID', 'SType', 'Score', 'SChange', 'Bind', 'BindChg', 'Bonus', 'BonusChg', 'RelateID','Luck','LuckChg'], 'integer'],
            [['Reason', 'UpdateTime'], 'safe'],
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

    public function load($data, $formName = null)
    {
        parent::load($data, $formName);
        $params = $data;
        if (!empty($params) && array_key_exists('UserScoreChangeSearch', $params)) {
            $data = $params['UserScoreChangeSearch'];
            if (isset($data['create_time'])){
                $this->create_time = $data['create_time'];
            }
            if (isset($data['end_time'])){
                $this->end_time = $data['end_time'];
            }
        }
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
        $query = UserScoreChange::find();

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
            'UID' => $this->UID,
            'NewUser' => $this->NewUser,
            'SpreadID' => $this->SpreadID,
            'SType' => $this->SType,
            'Score' => $this->Score,
            'SChange' => $this->SChange,
            'Bind' => $this->Bind,
            'BindChg' => $this->BindChg,
            'Bonus' => $this->Bonus,
            'BonusChg' => $this->BonusChg,
            'Luck' => $this->Luck,
            'LuckChg' => $this->LuckChg,
            'RelateID' => $this->RelateID,
            'UpdateTime' => $this->UpdateTime,
        ]);

        $query->andFilterWhere(['like', 'Reason', $this->Reason]);

        return $dataProvider;
    }
}
