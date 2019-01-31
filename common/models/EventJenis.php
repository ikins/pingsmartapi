<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_jenis".
 *
 * @property integer $Id
 * @property string $Jenis
 */
class EventJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Jenis'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Jenis' => 'Jenis',
        ];
    }
}
