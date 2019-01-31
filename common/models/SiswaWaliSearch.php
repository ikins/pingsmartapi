<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SiswaWali;

/**
 * SiswaWaliSearch represents the model behind the search form about `common\models\SiswaWali`.
 */
class SiswaWaliSearch extends SiswaWali
{
    /**
     * @inheritdoc
     */
	public $Nama;
    public function rules()
    {
        return [
            [['Id','IdFam', 'IsLive'], 'integer'],
			[['KodeWali','Nama'], 'string'],
            [['NIS', 'Remarks'], 'safe'],
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
        $query = SiswaWali::find()->joinWith('wali');

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
            'KodeWali' => $this->KodeWali,
            'IdFam' => $this->IdFam,
            'IsLive' => $this->IsLive,
        ]);

        $query->andFilterWhere(['like', 'NIS', $this->NIS])
            ->andFilterWhere(['like', 'Remarks', $this->Remarks])
			->andFilterWhere(['like', 'Nama', $this->Nama]);

        return $dataProvider;
    }
}
