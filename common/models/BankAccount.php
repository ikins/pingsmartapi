<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank_account".
 *
 * @property integer $Id
 * @property string $Bank
 * @property string $Rekening
 * @property string $Nama
 */
class BankAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Bank'], 'string', 'max' => 50],
            [['Rekening'], 'string', 'max' => 30],
            [['Nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Bank' => 'Bank',
            'Rekening' => 'Rekening',
            'Nama' => 'Nama',
        ];
    }
}
