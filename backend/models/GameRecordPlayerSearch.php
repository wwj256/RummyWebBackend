<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GameRecordPlayer;

/**
 * GameRecordPlayerSearch represents the model behind the search form of `backend\models\GameRecordPlayer`.
 */
class GameRecordPlayerSearch extends GameRecordPlayer
{
    public $create_time;
    public $end_time;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UID', 'RcdId', 'Turns', 'NewUser', 'SpreadID', 'BeginScore', 'WinScore', 'Bind', 'BindChg', 'Bonus', 'BonusChg', 'PlyTax'], 'integer'],
            [['BeginTime'], 'safe'],
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
        if (!empty($params) && array_key_exists('GameRecordPlayerSearch', $params)) {
            $data = $params['GameRecordPlayerSearch'];
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
        $query = GameRecordPlayer::find();

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
            'RcdId' => $this->RcdId,
            'Turns' => $this->Turns,
            'NewUser' => $this->NewUser,
            'SpreadID' => $this->SpreadID,
            'BeginScore' => $this->BeginScore,
            'WinScore' => $this->WinScore,
            'Bind' => $this->Bind,
            'BindChg' => $this->BindChg,
            'Bonus' => $this->Bonus,
            'BonusChg' => $this->BonusChg,
            'PlyTax' => $this->PlyTax,
            'BeginTime' => $this->BeginTime,
        ]);

        return $dataProvider;
    }
}
