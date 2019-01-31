<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa_record".
 *
 * @property integer $Id
 * @property string $Tanggal
 * @property string $NIS
 * @property integer $IdPel
 * @property integer $Point
 * @property string $IdPeg
 * @property string $Keterangan
 *
 * @property Pegawai $idPeg
 * @property Pelanggaran $idPel
 * @property Siswa $nIS
 */
class SiswaRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tanggal'], 'safe'],
            [['IdPel', 'Point'], 'integer'],
            [['NIS', 'IdPeg'], 'string', 'max' => 18],
            [['Keterangan'], 'string', 'max' => 500],
			[['Tanggal','IdPeg','IdPel','NIS'], 'required'],
            [['IdPeg'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['IdPeg' => 'IdPeg']],
            [['IdPel'], 'exist', 'skipOnError' => true, 'targetClass' => Pelanggaran::className(), 'targetAttribute' => ['IdPel' => 'Id']],
            [['NIS'], 'exist', 'skipOnError' => true, 'targetClass' => Siswa::className(), 'targetAttribute' => ['NIS' => 'NIS']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Tanggal' => 'Tanggal',
            'NIS' => 'Nis',
            'IdPel' => 'Id Pel',
            'Point' => 'Point',
            'IdPeg' => 'Id Peg',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['IdPeg' => 'IdPeg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggaran()
    {
        return $this->hasOne(Pelanggaran::className(), ['Id' => 'IdPel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswa()
    {
        return $this->hasOne(Siswa::className(), ['NIS' => 'NIS']);
    }
}
