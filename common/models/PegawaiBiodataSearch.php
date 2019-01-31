<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PegawaiBiodata;

/**
 * PegawaiBiodataSearch represents the model behind the search form about `common\models\PegawaiBiodata`.
 */
class PegawaiBiodataSearch extends PegawaiBiodata
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdProv', 'IdKab'], 'integer'],
            [['IdPeg', 'Nama', 'GelarDepan', 'GelarBelakang', 'Alamat', 'Kota', 'KotaLahir', 'TglLahir', 'JK', 'Telepon', 'HP', 'Pos', 'Foto', 'Keterangan'], 'safe'],
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
        $query = PegawaiBiodata::find();

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
            'IdProv' => $this->IdProv,
            'IdKab' => $this->IdKab,
            'TglLahir' => $this->TglLahir,
        ]);

        $query->andFilterWhere(['like', 'IdPeg', $this->IdPeg])
            ->andFilterWhere(['like', 'Nama', $this->Nama])
            ->andFilterWhere(['like', 'GelarDepan', $this->GelarDepan])
            ->andFilterWhere(['like', 'GelarBelakang', $this->GelarBelakang])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Kota', $this->Kota])
            ->andFilterWhere(['like', 'KotaLahir', $this->KotaLahir])
            ->andFilterWhere(['like', 'JK', $this->JK])
            ->andFilterWhere(['like', 'Telepon', $this->Telepon])
            ->andFilterWhere(['like', 'HP', $this->HP])
            ->andFilterWhere(['like', 'Pos', $this->Pos])
            ->andFilterWhere(['like', 'Foto', $this->Foto])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
