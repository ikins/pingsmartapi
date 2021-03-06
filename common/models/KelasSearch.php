<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kelas;

/**
 * KelasSearch represents the model behind the search form about `common\models\Kelas`.
 */
class KelasSearch extends Kelas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdGrade', 'IdJur', 'IdKom', 'Jumlah'], 'integer'],
            [['Kode', 'Kelas', 'IdWk'], 'safe'],
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
        $query = Kelas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['Kelas' => SORT_ASC]]
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
            'IdGrade' => $this->IdGrade,
            'IdJur' => $this->IdJur,
            'IdKom' => $this->IdKom,
            'Jumlah' => $this->Jumlah,
        ]);

        $query->andFilterWhere(['like', 'Kode', $this->Kode])
            ->andFilterWhere(['like', 'Kelas', $this->Kelas])
            ->andFilterWhere(['like', 'IdWk', $this->IdWk]);

        return $dataProvider;
    }
}
