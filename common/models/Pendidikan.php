<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pendidikan".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Pendidikan
 */
class Pendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pendidikan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kode'], 'string', 'max' => 4],
            [['Pendidikan'], 'string', 'max' => 30],
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
            'Pendidikan' => 'Pendidikan',
        ];
    }
}
