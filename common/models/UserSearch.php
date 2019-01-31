<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdPriv', 'Created', 'LastUpdate'], 'integer'],
            [['Username', 'Authkey', 'Password', 'PasswordResetToken', 'Email', 'MemberId', 'LastIP'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'IdPriv' => $this->IdPriv,
            'Created' => $this->Created,
            'LastUpdate' => $this->LastUpdate,
        ]);

        $query->andFilterWhere(['like', 'Username', $this->Username])
            ->andFilterWhere(['like', 'Authkey', $this->Authkey])
            ->andFilterWhere(['like', 'Password', $this->Password])
            ->andFilterWhere(['like', 'PasswordResetToken', $this->PasswordResetToken])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'MemberId', $this->MemberId])
            ->andFilterWhere(['like', 'LastIP', $this->LastIP]);

        return $dataProvider;
    }
}
