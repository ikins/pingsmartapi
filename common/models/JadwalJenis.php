<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jadwal_jenis".
 *
 * @property integer $Id
 * @property string $Jenis
 *
 * @property Jadwal[] $jadwals
 */
class JadwalJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal_jenis';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['IdJenis' => 'Id']);
    }
}
