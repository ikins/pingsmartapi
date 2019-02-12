<?php

namespace common;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pegawai;

/**
 * modelsPegawaiSearch represents the model behind the search form about `common\models\Pegawai`.
 */
class modelsPegawaiSearch extends Pegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdJab', 'IdStat'], 'integer'],
            [['IdPeg', 'Nama', 'NIP', 'MemberId'], 'safe'],
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
        $query = Pegawai::find();

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
            'IdJab' => $this->IdJab,
            'IdStat' => $this->IdStat,
        ]);

        $query->andFilterWhere(['like', 'IdPeg', $this->IdPeg])
            ->andFilterWhere(['like', 'Nama', $this->Nama])
            ->andFilterWhere(['like', 'NIP', $this->NIP])
            ->andFilterWhere(['like', 'MemberId', $this->MemberId]);

        return $dataProvider;
    }
}
