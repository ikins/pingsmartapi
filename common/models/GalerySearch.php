<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Galery;

/**
 * GalerySearch represents the model behind the search form about `common\models\Galery`.
 */
class GalerySearch extends Galery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdAlb', 'IsShown'], 'integer'],
            [['MemberId', 'Judul', 'Deskripsi', 'Image', 'UploadTime'], 'safe'],
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
        $query = Galery::find();

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
            'IdAlb' => $this->IdAlb,
            'IsShown' => $this->IsShown,
            'UploadTime' => $this->UploadTime,
        ]);

        $query->andFilterWhere(['like', 'MemberId', $this->MemberId])
            ->andFilterWhere(['like', 'Judul', $this->Judul])
            ->andFilterWhere(['like', 'Deskripsi', $this->Deskripsi])
            ->andFilterWhere(['like', 'Image', $this->Image]);

        return $dataProvider;
    }
}
