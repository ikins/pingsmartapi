<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pegawai;

/**
 * PegawaiSearch represents the model behind the search form about `common\models\Pegawai`.
 */
class PegawaiSearch extends Pegawai
{
    
	public $Nama;
    public function rules()
    {
        return [
            [['Id', 'IdJab', 'IdStat'], 'integer'],
            [['Nama','IdPeg', 'NIP', 'MemberId'], 'safe'],
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
        $query = Pegawai::find()->joinWith('biodata');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => ['defaultOrder' => ['IdJab' => SORT_ASC]]
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
            ->andFilterWhere(['like', 'NIP', $this->NIP])
			->andFilterWhere(['like', 'pegawai_biodata.Nama', $this->Nama])
            ->andFilterWhere(['like', 'MemberId', $this->MemberId]);

        return $dataProvider;
    }
}
