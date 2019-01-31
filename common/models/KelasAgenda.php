<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kelas_agenda".
 *
 * @property integer $Id
 * @property string $Judul
 * @property string $Deskripsi
 * @property string $TglAwal
 * @property string $JamAwal
 * @property string $TglAkhir
 * @property string $JamAkhir
 * @property string $KodeKelas
 * @property string $NIS
 * @property integer $IdStat
 * @property string $IdPeg
 * @property string $Keterangan
 */
class KelasAgenda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas_agenda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TglAwal', 'JamAwal', 'TglAkhir', 'JamAkhir'], 'safe'],
            [['IdStat'], 'integer'],
            [['Judul'], 'string', 'max' => 160],
            [['Deskripsi', 'Keterangan'], 'string', 'max' => 500],
            [['IdPeg'], 'string', 'max' => 18],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Judul' => 'Judul',
            'Deskripsi' => 'Deskripsi',
            'TglAwal' => 'Tgl Awal',
            'JamAwal' => 'Jam Awal',
            'TglAkhir' => 'Tgl Akhir',
            'JamAkhir' => 'Jam Akhir',
            'KodeKelas' => 'Kode Kelas',
            'NIS' => 'Nis',
            'IdStat' => 'Id Stat',
            'IdPeg' => 'Id Peg',
            'Keterangan' => 'Keterangan',
        ];
    }
}
