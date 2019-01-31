<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marital".
 *
 * @property integer $Id
 * @property string $Status
 */
class Marital extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marital';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Status'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Status' => 'Status',
        ];
    }
}
