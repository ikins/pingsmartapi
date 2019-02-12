<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "golongan_darah".
 *
 * @property integer $id
 * @property string $GolDar
 */
class GolonganDarah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'golongan_darah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GolDar'], 'required'],
            [['GolDar'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'GolDar' => 'Gol Dar',
        ];
    }
}
