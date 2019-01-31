<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KelasAgenda;

/**
 * KelasAgendaSearch represents the model behind the search form about `common\models\KelasAgenda`.
 */
class KelasAgendaSearch extends KelasAgenda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdStat'], 'integer'],
            [['Judul', 'Deskripsi', 'TglAwal', 'JamAwal', 'TglAkhir', 'JamAkhir', 'KodeKelas', 'NIS', 'IdPeg', 'Keterangan'], 'safe'],
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
        $query = KelasAgenda::find();

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
            'TglAwal' => $this->TglAwal,
            'JamAwal' => $this->JamAwal,
            'TglAkhir' => $this->TglAkhir,
            'JamAkhir' => $this->JamAkhir,
            'IdStat' => $this->IdStat,
        ]);

        $query->andFilterWhere(['like', 'Judul', $this->Judul])
            ->andFilterWhere(['like', 'Deskripsi', $this->Deskripsi])
            ->andFilterWhere(['like', 'KodeKelas', $this->KodeKelas])
            ->andFilterWhere(['like', 'NIS', $this->NIS])
            ->andFilterWhere(['like', 'IdPeg', $this->IdPeg])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
