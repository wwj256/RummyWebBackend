<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserLoginOut;

/**
 * UserLoginOutSearch represents the model behind the search form of `backend\models\UserLoginOut`.
 */
class UserLoginOutSearch extends UserLoginOut
{
    public $create_time;
    public $end_time;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'UID', 'IsLogin', 'SpreadID', 'IsNew', 'OnTime'], 'integer'],
            [['UpdateTime'], 'safe'],
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
        if (!empty($params)) {
            if( !isset($params['UserLoginOutSearch']) ){
                return;
            }
            $data = $params['UserLoginOutSearch'];
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
        $query = UserLoginOut::find();

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
            'IsLogin' => $this->IsLogin,
            'SpreadID' => $this->SpreadID,
            'IsNew' => $this->IsNew,
            'OnTime' => $this->OnTime,
            'UpdateTime' => $this->UpdateTime,
        ]);

        return $dataProvider;
    }
}
