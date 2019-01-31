<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Identity;

/**
 * IdentitySearch represents the model behind the search form about `common\models\Identity`.
 */
class IdentitySearch extends Identity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdLev', 'IdStat', 'IdCore', 'IdKab', 'IdProv'], 'integer'],
            [['NPSN', 'Sekolah', 'Alamat', 'Kota', 'Telepon', 'HP', 'Email', 'Website', 'Logo'], 'safe'],
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
        $query = Identity::find();

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
            'IdLev' => $this->IdLev,
            'IdStat' => $this->IdStat,
            'IdCore' => $this->IdCore,
            'IdKab' => $this->IdKab,
            'IdProv' => $this->IdProv,
        ]);

        $query->andFilterWhere(['like', 'NPSN', $this->NPSN])
            ->andFilterWhere(['like', 'Sekolah', $this->Sekolah])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Kota', $this->Kota])
            ->andFilterWhere(['like', 'Telepon', $this->Telepon])
            ->andFilterWhere(['like', 'HP', $this->HP])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Website', $this->Website])
            ->andFilterWhere(['like', 'Logo', $this->Logo]);

        return $dataProvider;
    }
}
