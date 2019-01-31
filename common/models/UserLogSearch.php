<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserLog;

/**
 * UserLogSearch represents the model behind the search form about `common\models\UserLog`.
 */
class UserLogSearch extends UserLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'UserId', 'IdStat'], 'integer'],
            [['Activity', 'IP', 'LoginTime', 'LogoutTime', 'ParentURL', 'Remark'], 'safe'],
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
        $query = UserLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'UserId' => $this->UserId,
            'LoginTime' => $this->LoginTime,
            'LogoutTime' => $this->LogoutTime,
            'IdStat' => $this->IdStat,
        ]);

        $query->andFilterWhere(['like', 'Activity', $this->Activity])
            ->andFilterWhere(['like', 'IP', $this->IP])
            ->andFilterWhere(['like', 'ParentURL', $this->ParentURL])
            ->andFilterWhere(['like', 'Remark', $this->Remark]);

        return $dataProvider;
    }
}
