<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hari".
 *
 * @property integer $Id
 * @property string $Hari
 */
class Hari extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hari';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Hari'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Hari' => 'Hari',
        ];
    }
}
