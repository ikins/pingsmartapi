<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_model".
 *
 * @property integer $Id
 * @property string $Payment
 *
 * @property Payment[] $payments
 */
class PaymentModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Payment'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Payment' => 'Payment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['IdPay' => 'Id']);
    }
}
