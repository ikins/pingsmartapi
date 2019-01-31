<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kelas_level".
 *
 * @property integer $Id
 * @property integer $Level
 */
class KelasLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Level'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Level' => 'Level',
        ];
    }
}
