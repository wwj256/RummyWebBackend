<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserOrderInfo;
use Yii;

/**
 * UserOrderInfoSearch represents the model behind the search form of `backend\models\UserOrderInfo`.
 */
class UserOrderInfoSearch extends UserOrderInfo
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
            [['ID', 'ScoreAmount', 'UserID', 'UserEndScore', 'CouponID', 'Amount', 'Status'], 'integer'],
            [['OrderID', 'ReferenceId', 'PaymentMode', 'PayTime', 'CreateTime'], 'safe'],
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
        $query = UserOrderInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /*这里的articlecategory是article模型里面关联的方法名，除了首字母，其他都要完全一样，否则会报错*/


        $this->load($params);
        if (!empty($params)) {
            $data = $params['UserOrderInfoSearch'];
            if (isset($data['create_time'])){
                $this->create_time = $data['create_time'];
            }
            if (isset($data['end_time'])){
                $this->end_time = $data['end_time'];
            }
            if (isset($data['NickName']) && $data['NickName']){
                $this->NickName = $data['NickName'];
                Yii::warning("nickName=".$this->NickName);
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
            'ScoreAmount' => $this->ScoreAmount,
            'UserID' => $this->UserID,
            'UserEndScore' => $this->UserEndScore,
            'CouponID' => $this->CouponID,
            'Amount' => $this->Amount,
            'Status' => $this->Status,
            'PayTime' => $this->PayTime,
            'CreateTime' => $this->CreateTime,
        ]);

        $query->andFilterWhere(['like', 'OrderID', $this->OrderID])
            ->andFilterWhere(['like', 'ReferenceId', $this->ReferenceId])
            ->andFilterWhere(['like', 'PaymentMode', $this->PaymentMode])
            ->andFilterWhere(['>=', 'CreateTime', $this->create_time])
            ->andFilterWhere(['<=', 'CreateTime', $this->end_time])
            ->andFilterWhere(['=', 'account_info.NickName', $this->NickName])
            ->orderBy('CreateTime DESC');

        return $dataProvider;
    }
}
