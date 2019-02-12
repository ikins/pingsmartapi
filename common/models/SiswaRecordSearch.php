<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SiswaRecord;

/**
 * SiswaRecordSearch represents the model behind the search form about `common\models\SiswaRecord`.
 */
class SiswaRecordSearch extends SiswaRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdPel', 'Point'], 'integer'],
            [['Tanggal', 'NIS', 'IdPeg', 'Keterangan'], 'safe'],
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
        $query = SiswaRecord::find()->JoinWith(['pegawai', 'pelanggaran', 'siswa']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'sort'=> ['defaultOrder' => ['Tanggal' => SORT_ASC]]
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
            'IdPel' => $this->IdPel,
            'Point' => $this->Point,
        ]);

        $query->andFilterWhere(['like', 'NIS', $this->NIS])
            ->andFilterWhere(['like', 'IdPeg', $this->IdPeg])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
