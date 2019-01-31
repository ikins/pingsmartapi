<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bulan".
 *
 * @property integer $Id
 * @property string $Bulan
 */
class Bulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bulan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Bulan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Bulan' => 'Bulan',
        ];
    }
}
