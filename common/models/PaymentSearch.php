<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Payment;

/**
 * PaymentSearch represents the model behind the search form about `common\models\Payment`.
 */
class PaymentSearch extends Payment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdPay', 'IdStat', 'IdBank'], 'integer'],
            [['Tanggal', 'MemberId', 'InvNo', 'BankAsal', 'RekeningAsal', 'NamaRekAsal', 'Keterangan', 'Attachment'], 'safe'],
            [['Jumlah'], 'number'],
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
        $query = Payment::find();

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
            'Jumlah' => $this->Jumlah,
            'IdPay' => $this->IdPay,
            'IdStat' => $this->IdStat,
            'IdBank' => $this->IdBank,
        ]);

        $query->andFilterWhere(['like', 'MemberId', $this->MemberId])
            ->andFilterWhere(['like', 'InvNo', $this->InvNo])
            ->andFilterWhere(['like', 'BankAsal', $this->BankAsal])
            ->andFilterWhere(['like', 'RekeningAsal', $this->RekeningAsal])
            ->andFilterWhere(['like', 'NamaRekAsal', $this->NamaRekAsal])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan])
            ->andFilterWhere(['like', 'Attachment', $this->Attachment]);

        return $dataProvider;
    }
}
