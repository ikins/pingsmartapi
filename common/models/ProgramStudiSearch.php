<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProgramStudi;

/**
 * ProgramStudiSearch represents the model behind the search form about `common\models\ProgramStudi`.
 */
class ProgramStudiSearch extends ProgramStudi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdBidang'], 'integer'],
            [['ProgramStudi'], 'safe'],
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
        $query = ProgramStudi::find();

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
            'Id' => $this->Id,
            'IdBidang' => $this->IdBidang,
        ]);

        $query->andFilterWhere(['like', 'ProgramStudi', $this->ProgramStudi]);

        return $dataProvider;
    }
}
