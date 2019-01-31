<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Jadwal;

/**
 * JadwalSearch represents the model behind the search form about `common\models\Jadwal`.
 */
class JadwalSearch extends Jadwal
{
    /**
     * @inheritdoc
     */
	public $Pelajaran;
    public function rules()
    {
        return [
            [['Id', 'IdJenis', 'IdHari'], 'integer'],
            [['KodeKelas','Pelajaran','KodePel', 'JamMulai', 'JamAkhir', 'IdGuru', 'Keterangan'], 'safe'],
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
        $query = Jadwal::find()->joinWith('pelajaran');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => ['defaultOrder' => ['KodeKelas' => SORT_ASC,'IdHari' => SORT_ASC]]
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
            'IdJenis' => $this->IdJenis,
            'IdHari' => $this->IdHari,
            'JamMulai' => $this->JamMulai,
            'JamAkhir' => $this->JamAkhir,
        ]);

        $query->andFilterWhere(['like', 'KodeKelas', $this->KodeKelas])
            ->andFilterWhere(['like', 'KodePel', $this->KodePel])
            ->andFilterWhere(['like', 'IdGuru', $this->IdGuru])
			->andFilterWhere(['like', 'pelajaran.Pelajaran', $this->Pelajaran])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
	
	public function searchbyGuru($params)
    {
        $query = Jadwal::find()->joinWith('pelajaran');

       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => ['defaultOrder' => ['IdHari' => SORT_ASC]]
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
            'IdJenis' => $this->IdJenis,
            'IdHari' => $this->IdHari,
            'JamMulai' => $this->JamMulai,
            'JamAkhir' => $this->JamAkhir,
        ]);

        $query->andFilterWhere(['like', 'KodeKelas', $this->KodeKelas])
            ->andFilterWhere(['like', 'KodePel', $this->KodePel])
            ->andFilterWhere(['like', 'IdGuru', $this->IdGuru])
			->andFilterWhere(['like', 'pelajaran.Pelajaran', $this->Pelajaran])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
