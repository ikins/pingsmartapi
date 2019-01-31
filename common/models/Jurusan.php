<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jurusan".
 *
 * @property integer $Id
 * @property string $Jurusan
 *
 * @property Kelas[] $kelas
 */
class Jurusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Jurusan'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Jurusan' => 'Jurusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['IdJur' => 'Id']);
    }
}
