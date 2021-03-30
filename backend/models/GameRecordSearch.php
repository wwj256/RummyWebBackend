<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GameRecord;

/**
 * GameRecordSearch represents the model behind the search form of `backend\models\GameRecord`.
 */
class GameRecordSearch extends GameRecord
{
    public $create_time;
    public $end_time;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RcdId', 'Turns', 'GameId', 'RoomId', 'PlyNum', 'Tax', 'SysWin', 'TimeCost'], 'integer'],
            [['Procedure', 'BeginTime'], 'safe'],
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
        if (!empty($params) && array_key_exists('GameRecordSearch', $params)) {
            $data = $params['GameRecordSearch'];
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
        $query = GameRecord::find();

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
            'RcdId' => $this->RcdId,
            'Turns' => $this->Turns,
            'GameId' => $this->GameId,
            'RoomId' => $this->RoomId,
            'PlyNum' => $this->PlyNum,
            'Tax' => $this->Tax,
            'SysWin' => $this->SysWin,
            'TimeCost' => $this->TimeCost,
            'BeginTime' => $this->BeginTime,
        ]);

        $query->andFilterWhere(['like', 'Procedure', $this->Procedure]);

        return $dataProvider;
    }
}
