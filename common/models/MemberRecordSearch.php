<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MemberRecord;

/**
 * MemberRecordSearch represents the model behind the search form about `common\models\MemberRecord`.
 */
class MemberRecordSearch extends MemberRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Durasi'], 'integer'],
            [['Tanggal', 'MemberId', 'Kode', 'Expired', 'Keterangan'], 'safe'],
            [['Harga'], 'number'],
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
        $query = MemberRecord::find();

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
            'Durasi' => $this->Durasi,
            'Harga' => $this->Harga,
            'Expired' => $this->Expired,
        ]);

        $query->andFilterWhere(['like', 'MemberId', $this->MemberId])
            ->andFilterWhere(['like', 'Kode', $this->Kode])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
