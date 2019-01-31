<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presensi".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Presensi
 */
class Presensi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presensi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kode'], 'string', 'max' => 1],
            [['Presensi'], 'string', 'max' => 20],
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
            'Presensi' => 'Presensi',
        ];
    }
}
