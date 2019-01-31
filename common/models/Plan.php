<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Plan
 * @property integer $Durasi
 * @property string $Harga
 * @property string $Keterangan
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Durasi'], 'integer'],
            [['Harga'], 'number'],
            [['Kode'], 'string', 'max' => 8],
            [['Plan'], 'string', 'max' => 20],
            [['Keterangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Kode' => 'Kode',
            'Plan' => 'Plan',
            'Durasi' => 'Durasi',
            'Harga' => 'Harga',
            'Keterangan' => 'Keterangan',
        ];
    }
}
