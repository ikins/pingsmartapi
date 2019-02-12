<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Member;

/**
 * MemberSearch represents the model behind the search form about `common\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdStat', 'IdLev', 'RemainPeriode'], 'integer'],
            [['MemberId', 'Nama', 'Status', 'Avatar', 'ActivationDate', 'ExpiredDate', 'GracePeriode', 'KodePlan'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Member::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'sort'=> ['defaultOrder' => ['Nama' => SORT_ASC]]
    ]);
       

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'IdStat' => $this->IdStat,
            'IdLev' => $this->IdLev,
            'ActivationDate' => $this->ActivationDate,
            'RemainPeriode' => $this->RemainPeriode,
            'ExpiredDate' => $this->ExpiredDate,
            'GracePeriode' => $this->GracePeriode,
        ]);

        $query->andFilterWhere(['like', 'MemberId', $this->MemberId])
            ->andFilterWhere(['like', 'Nama', $this->Nama])
            ->andFilterWhere(['like', 'Status', $this->Status])
            ->andFilterWhere(['like', 'Avatar', $this->Avatar])
            ->andFilterWhere(['like', 'KodePlan', $this->KodePlan]);

        return $dataProvider;
    }
}
