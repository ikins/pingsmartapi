<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $Id
 * @property string $Event
 * @property string $Deskripsi
 * @property integer $IdJenis
 * @property string $Tanggal
 * @property string $TanggalAkhir
 * @property string $JamMulai
 * @property string $JamSelesai
 * @property string $Tempat
 * @property integer $IdStat
 * @property string $Keterangan
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Deskripsi'], 'required'],
            [['Deskripsi'], 'string'],
            [['IdJenis', 'IdStat'], 'integer'],
            [['Tanggal', 'TanggalAkhir', 'JamMulai', 'JamSelesai'], 'safe'],
            [['Event', 'Tempat'], 'string', 'max' => 100],
            [['Keterangan'], 'string', 'max' => 160],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Event' => 'Event',
            'Deskripsi' => 'Deskripsi',
            'IdJenis' => 'Id Jenis',
            'Tanggal' => 'Tanggal',
            'TanggalAkhir' => 'Tanggal Akhir',
            'JamMulai' => 'Jam Mulai',
            'JamSelesai' => 'Jam Selesai',
            'Tempat' => 'Tempat',
            'IdStat' => 'Id Stat',
            'Keterangan' => 'Keterangan',
        ];
    }
	
	public function getJenis()
    {
        return $this->hasOne(EventJenis::className(), ['Id' => 'IdJenis']);
    }
	
	public function getStatus()
    {
        return $this->hasOne(EventStatus::className(), ['Id' => 'IdStat']);
    }
}
