<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DayReport;

/**
 * DayReportSearch represents the model behind the search form of `backend\models\DayReport`.
 */
class DayReportSearch extends DayReport
{
    public $create_time;
    public $end_time;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DayDate'], 'safe'],
            [['NewPlayers', 'FirstDeposit', 'SecondDeposit', 'AverageOnline', 'TotalDeposit', 'TotalWithdraw', 'TotalBonus', 'TotalFee', 'TotalRake', 'UseBonus'], 'integer'],
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
        if (!empty($params) && array_key_exists('DayReportSearch', $params)) {
            $data = $params['DayReportSearch'];
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
        $query = DayReport::find();

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
            'DayDate' => $this->DayDate,
            'NewPlayers' => $this->NewPlayers,
            'FirstDeposit' => $this->FirstDeposit,
            'SecondDeposit' => $this->SecondDeposit,
            'AverageOnline' => $this->AverageOnline,
            'TotalDeposit' => $this->TotalDeposit,
            'TotalWithdraw' => $this->TotalWithdraw,
            'TotalBonus' => $this->TotalBonus,
            'TotalFee' => $this->TotalFee,
            'TotalRake' => $this->TotalRake,
            'UseBonus' => $this->UseBonus,
        ]);

        $query->andFilterWhere(['>=', 'DayDate', $this->create_time])
            ->andFilterWhere(['<=', 'DayDate', $this->end_time])
            ->orderBy('DayDate DESC');

        return $dataProvider;
    }
}
