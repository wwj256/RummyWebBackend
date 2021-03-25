<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserWithdrawInfo;

/**
 * UserWithdrawInfoSearch represents the model behind the search form of `backend\models\UserWithdrawInfo`.
 */
class UserWithdrawInfoSearch extends UserWithdrawInfo
{
    public $NickName;
    public $create_time;
    public $end_time;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'UserID', 'Amount', 'BeforeScore', 'Tax', 'Status', 'ClubLV', 'OperatorID'], 'integer'],
            [['Desc', 'OperatorTime', 'WithDrawTime', 'CreateTime'], 'safe'],
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
        if (!empty($params) && array_key_exists('UserWithdrawInfoSearch', $params)) {
            $data = $params['UserWithdrawInfoSearch'];
            if (isset($data['create_time'])){
                $this->create_time = $data['create_time'];
            }
            if (isset($data['end_time'])){
                $this->end_time = $data['end_time'];
            }
            if (isset($data['NickName']) && $data['NickName']){
                $this->NickName = $data['NickName'];
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
        $query = UserWithdrawInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!empty($params)) {
            $data = $params['UserWithdrawInfoSearch'];
            if (isset($data['NickName']) && $data['NickName']){
                $query->select('user_order_info.*, account_info.NickName');
                $query->joinWith("account_info");
            }
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'UserID' => $this->UserID,
            'Amount' => $this->Amount,
            'BeforeScore' => $this->BeforeScore,
            'Tax' => $this->Tax,
            'Status' => $this->Status,
            'ClubLV' => $this->ClubLV,
            'OperatorID' => $this->OperatorID,
            'OperatorTime' => $this->OperatorTime,
            'WithDrawTime' => $this->WithDrawTime,
            'CreateTime' => $this->CreateTime,
            'Status' => 0,
        ]);

        $query->andFilterWhere(['like', 'Desc', $this->Desc]);

        $query->andFilterWhere(['>=', 'CreateTime', $this->create_time])
            ->andFilterWhere(['<=', 'CreateTime', $this->end_time])
            ->andFilterWhere(['=', 'account_info.NickName', $this->NickName])
            ->orderBy('CreateTime DESC');

        return $dataProvider;
    }
}
