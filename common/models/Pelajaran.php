<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelajaran".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Pelajaran
 * @property integer $IdGroup
 * @property string $Keterangan
 *
 * @property Jadwal[] $jadwals
 * @property PelajaranGroup $idGroup
 */
class Pelajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdGroup'], 'integer'],
            [['Kode'], 'string', 'max' => 8],
            [['Pelajaran'], 'string', 'max' => 50],
            [['Keterangan'], 'string', 'max' => 255],
            [['Kode'], 'unique'],
            [['IdGroup'], 'exist', 'skipOnError' => true, 'targetClass' => PelajaranGroup::className(), 'targetAttribute' => ['IdGroup' => 'Id']],
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
            'Pelajaran' => 'Pelajaran',
            'IdGroup' => 'Id Group',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['KodePel' => 'Kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(PelajaranGroup::className(), ['Id' => 'IdGroup']);
    }
}
