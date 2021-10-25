<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserStatInfo;

/**
 * UserStatInfoSearch represents the model behind the search form of `backend\models\UserStatInfo`.
 */
class UserStatInfoSearch extends UserStatInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserID', 'TPayScore', 'TPayCnt', 'TDrawScore', 'TDrawCnt', 'TGameCnt', 'TBrokeUp', 'TWinScore', 'TLostScore', 'TPointCnt', 'TPoolCnt', 'TDealCnt', 'TPoint10Cnt', 'TMatchCnt', 'TTicketScore', 'TAssistScore', 'TInviteScore', 'TGameTax'], 'integer'],
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
        $query = UserStatInfo::find();

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
            'UserID' => $this->UserID,
            'TPayScore' => $this->TPayScore,
            'TPayCnt' => $this->TPayCnt,
            'TDrawScore' => $this->TDrawScore,
            'TDrawCnt' => $this->TDrawCnt,
            'TGameCnt' => $this->TGameCnt,
            'TBrokeUp' => $this->TBrokeUp,
            'TWinScore' => $this->TWinScore,
            'TLostScore' => $this->TLostScore,
            'TPointCnt' => $this->TPointCnt,
            'TPoolCnt' => $this->TPoolCnt,
            'TDealCnt' => $this->TDealCnt,
            'TPoint10Cnt' => $this->TPoint10Cnt,
            'TMatchCnt' => $this->TMatchCnt,
            'TTicketScore' => $this->TTicketScore,
            'TAssistScore' => $this->TAssistScore,
            'TInviteScore' => $this->TInviteScore,
            'TGameTax' => $this->TGameTax,
        ]);

        return $dataProvider;
    }
}
