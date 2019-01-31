<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Event;

/**
 * EventSearch represents the model behind the search form about `common\models\Event`.
 */
class EventSearch extends Event
{
    
	public $Awal;
	public $Akhir;
    public function rules()
    {
        return [
            [['Id', 'IdJenis', 'IdStat'], 'integer'],
            [['Event', 'Deskripsi', 'Tanggal', 'TanggalAkhir', 'JamMulai', 'JamSelesai', 'Tempat', 'Keterangan','Awal','Akhir'], 'safe'],
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
        $query = Event::find();

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
            'IdJenis' => $this->IdJenis,
            'JamMulai' => $this->JamMulai,
            'JamSelesai' => $this->JamSelesai,
            'IdStat' => $this->IdStat,
        ]);

        $query->andFilterWhere(['like', 'Event', $this->Event])
            ->andFilterWhere(['like', 'Deskripsi', $this->Deskripsi])
            ->andFilterWhere(['like', 'Tempat', $this->Tempat])
			->andFilterWhere(['between', 'Tanggal', $this->Awal,$this->Akhir])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
