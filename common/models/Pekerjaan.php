<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pekerjaan".
 *
 * @property integer $Id
 * @property string $Pekerjaan
 */
class Pekerjaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pekerjaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Pekerjaan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Pekerjaan' => 'Pekerjaan',
        ];
    }
}
