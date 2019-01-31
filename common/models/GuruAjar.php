<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guru_ajar".
 *
 * @property integer $Id
 * @property string $IdPeg
 * @property string $KodePel
 * @property string $KodeKelas
 * @property string $Keterangan
 *
 * @property Kelas $kodeKelas
 * @property Pegawai $idPeg
 * @property Pelajaran $kodePel
 */
class GuruAjar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guru_ajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdPeg', 'KodePel'], 'string', 'max' => 18],
            [['KodeKelas'], 'string', 'max' => 8],
            [['Keterangan'], 'string', 'max' => 255],
            [['KodeKelas'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['KodeKelas' => 'Kode']],
            [['IdPeg'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['IdPeg' => 'IdPeg']],
            [['KodePel'], 'exist', 'skipOnError' => true, 'targetClass' => Pelajaran::className(), 'targetAttribute' => ['KodePel' => 'Kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'IdPeg' => 'Id Peg',
            'KodePel' => 'Kode Pel',
            'KodeKelas' => 'Kode Kelas',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['Kode' => 'KodeKelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuru()
    {
        return $this->hasOne(Pegawai::className(), ['IdPeg' => 'IdPeg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelajaran()
    {
        return $this->hasOne(Pelajaran::className(), ['Kode' => 'KodePel']);
    }
}
