<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelanggaran".
 *
 * @property integer $Id
 * @property string $Pelanggaran
 * @property integer $IdKat
 * @property integer $Point
 * @property string $Keterangan
 *
 * @property PelanggaranKategori $idKat
 */
class Pelanggaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelanggaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdKat', 'Point'], 'integer'],
            [['Pelanggaran'], 'string', 'max' => 160],
            [['Keterangan'], 'string', 'max' => 255],
            [['IdKat'], 'exist', 'skipOnError' => true, 'targetClass' => PelanggaranKategori::className(), 'targetAttribute' => ['IdKat' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Pelanggaran' => 'Pelanggaran',
            'IdKat' => 'Id Kat',
            'Point' => 'Point',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(PelanggaranKategori::className(), ['Id' => 'IdKat']);
    }
}
