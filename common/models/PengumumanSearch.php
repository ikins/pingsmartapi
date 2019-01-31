<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pengumuman;

/**
 * PengumumanSearch represents the model behind the search form about `common\models\Pengumuman`.
 */
class PengumumanSearch extends Pengumuman
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdStat'], 'integer'],
            [['Tanggal', 'Judul', 'Pengumuman', 'Target', 'KodeKelas', 'BeginPublish', 'EndPublish', 'Keterangan','IdPeg'], 'safe'],
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
        $query = Pengumuman::find();

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
            'IdStat' => $this->IdStat,
			'IdPeg' => $this->IdPeg,
            'BeginPublish' => $this->BeginPublish,
            'EndPublish' => $this->EndPublish,
        ]);

        $query->andFilterWhere(['like', 'Judul', $this->Judul])
            ->andFilterWhere(['like', 'Pengumuman', $this->Pengumuman])
            ->andFilterWhere(['like', 'Target', $this->Target])
            ->andFilterWhere(['like', 'KodeKelas', $this->KodeKelas])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
