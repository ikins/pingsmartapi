<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SiswaBiodata;

/**
 * SiswaBiodataSearch represents the model behind the search form about `common\models\SiswaBiodata`.
 */
class SiswaBiodataSearch extends SiswaBiodata
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdAgm', 'IdKab', 'IdProv', 'IdDom', 'IdKabDom', 'IdProvDom'], 'integer'],
            [['NIS', 'Nama', 'JK', 'KotaLahir', 'TglLahir', 'Alamat', 'Kota', 'Telepon', 'Pos', 'AlamatDom', 'KotaDom', 'TeleponDom', 'Foto', 'Keterangan'], 'safe'],
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
        $query = SiswaBiodata::find();

        // add conditions that should always apply here

         $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'sort'=> ['defaultOrder' => ['JK' => SORT_ASC]]
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
            'TglLahir' => $this->TglLahir,
            'IdAgm' => $this->IdAgm,
            'IdKab' => $this->IdKab,
            'IdProv' => $this->IdProv,
            'IdDom' => $this->IdDom,
            'IdKabDom' => $this->IdKabDom,
            'IdProvDom' => $this->IdProvDom,
        ]);

        $query->andFilterWhere(['like', 'NIS', $this->NIS])
            ->andFilterWhere(['like', 'Nama', $this->Nama])
            ->andFilterWhere(['like', 'JK', $this->JK])
            ->andFilterWhere(['like', 'KotaLahir', $this->KotaLahir])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Kota', $this->Kota])
            ->andFilterWhere(['like', 'Telepon', $this->Telepon])
            ->andFilterWhere(['like', 'Pos', $this->Pos])
            ->andFilterWhere(['like', 'AlamatDom', $this->AlamatDom])
            ->andFilterWhere(['like', 'KotaDom', $this->KotaDom])
            ->andFilterWhere(['like', 'TeleponDom', $this->TeleponDom])
            ->andFilterWhere(['like', 'Foto', $this->Foto])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
