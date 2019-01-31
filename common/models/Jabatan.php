<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jabatan".
 *
 * @property integer $Id
 * @property string $Jabatan
 *
 * @property Pegawai[] $pegawais
 */
class Jabatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jabatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Jabatan'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Jabatan' => 'Jabatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawais()
    {
        return $this->hasMany(Pegawai::className(), ['IdJab' => 'Id']);
    }
}
