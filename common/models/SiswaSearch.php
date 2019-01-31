<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Siswa;

/**
 * SiswaSearch represents the model behind the search form about `common\models\Siswa`.
 */
class SiswaSearch extends Siswa
{
    /**
     * @inheritdoc
     */
	public $Nama;
    public function rules()
    {
        return [
            [['Id', 'ThnMasuk', 'Point', 'IsActive'], 'integer'],
            [['NIS', 'NISN', 'KodeKelas'], 'safe'],
			[['Nama'], 'string'],
            [['Billing'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
       

	   $query = Siswa::find()->joinWith('biodata');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			//'sort' => ['defaultOrder' => ['`siswa_biodata`.`Nama`' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'ThnMasuk' => $this->ThnMasuk,
            'Point' => $this->Point,
            'Billing' => $this->Billing,
            'IsActive' => $this->IsActive,
        ]);

        $query->andFilterWhere(['like', 'siswa.NIS', $this->NIS])
            ->andFilterWhere(['like', 'NISN', $this->NISN])
			->andFilterWhere(['like', 'siswa_biodata.Nama', $this->Nama])
            ->andFilterWhere(['like', 'KodeKelas', $this->KodeKelas]);

        return $dataProvider;
    }
}
