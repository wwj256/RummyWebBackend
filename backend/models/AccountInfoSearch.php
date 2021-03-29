<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccountInfo;
use Yii;

/**
 * AccountInfoSearch represents the model behind the search form of `backend\models\AccountInfo`.
 */
class AccountInfoSearch extends AccountInfo
{
    public $create_time;
    public $end_time;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserID', 'SpreadID', 'IsRobot', 'Platform'], 'integer'],
            [['UniqueID', 'Password', 'NickName', 'FaceUrl', 'RegisterIP', 'RegisterDate', 'RegisterMachine', 'ClientVersion', 'LoginIP', 'LoginDate', 'LoginMachine'], 'safe'],
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
        if (!empty($params) && array_key_exists('AccountInfoSearch', $params)) {
            $data = $params['AccountInfoSearch'];
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
        $query = AccountInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        Yii::warning(json_encode($params));
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'UserID' => $this->UserID,
            'SpreadID' => $this->SpreadID,
            'IsRobot' => $this->IsRobot,
            'Platform' => $this->Platform,
            'RegisterDate' => $this->RegisterDate,
            'LoginDate' => $this->LoginDate,
        ]);

        $query->andFilterWhere(['like', 'UniqueID', $this->UniqueID])
            ->andFilterWhere(['like', 'Password', $this->Password])
            ->andFilterWhere(['like', 'NickName', $this->NickName])
            ->andFilterWhere(['like', 'FaceUrl', $this->FaceUrl])
            ->andFilterWhere(['like', 'RegisterIP', $this->RegisterIP])
            ->andFilterWhere(['like', 'RegisterMachine', $this->RegisterMachine])
            ->andFilterWhere(['like', 'ClientVersion', $this->ClientVersion])
            ->andFilterWhere(['like', 'LoginIP', $this->LoginIP])
            ->andFilterWhere(['like', 'LoginMachine', $this->LoginMachine])
            ->andFilterWhere(['>=', 'RegisterDate', $this->create_time])
            ->andFilterWhere(['<=', 'RegisterDate', $this->end_time])
            ->orderBy('UserID DESC');
        Yii::warning('$this->create_time='.$this->create_time."  ".$this->UserID."  ");


        return $dataProvider;

    }
}
