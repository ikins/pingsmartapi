<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Nilai;

/**
 * NilaiSearch represents the model behind the search form about `common\models\Nilai`.
 */
class NilaiSearch extends Nilai
{
    /**
     * @inheritdoc
     */
	public $Pelajaran;
    public function rules()
    {
        return [
            [['Id', 'IdJenis'], 'integer'],
            [['Kode','Pelajaran', 'Tanggal', 'KodeKelas', 'IdPeg', 'Keterangan'], 'safe'],
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
        $query = Nilai::find()->joinWith('pelajaran');

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
            'Tanggal' => $this->Tanggal,
            'IdJenis' => $this->IdJenis,
        ]);

        $query->andFilterWhere(['like', 'Kode', $this->Kode])
            ->andFilterWhere(['like', 'KodeKelas', $this->KodeKelas])
            ->andFilterWhere(['like', 'IdPeg', $this->IdPeg])
			->andFilterWhere(['like', 'pelajaran.Pelajaran', $this->Pelajaran])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
