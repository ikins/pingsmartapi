<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NilaiDetail;

/**
 * NilaiDetailSearch represents the model behind the search form about `common\models\NilaiDetail`.
 */
class NilaiDetailSearch extends NilaiDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdStat'], 'integer'],
            [['Kode', 'NIS', 'KodePel', 'TglInput', 'Keterangan'], 'safe'],
            [['Nilai', 'Standar'], 'number'],
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
        $query = NilaiDetail::find();

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
            'Nilai' => $this->Nilai,
            'Standar' => $this->Standar,
            'IdStat' => $this->IdStat,
            'TglInput' => $this->TglInput,
        ]);

        $query->andFilterWhere(['like', 'Kode', $this->Kode])
            ->andFilterWhere(['like', 'NIS', $this->NIS])
            ->andFilterWhere(['like', 'KodePel', $this->KodePel])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
