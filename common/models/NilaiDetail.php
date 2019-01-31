<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nilai_detail".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $NIS
 * @property string $KodePel
 * @property string $Nilai
 * @property string $Standar
 * @property integer $IdStat
 * @property string $TglInput
 * @property string $Keterangan
 *
 * @property Nilai $kode
 * @property NilaiStatus $idStat
 * @property Pelajaran $kodePel
 * @property Siswa $nIS
 */
class NilaiDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nilai_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nilai', 'Standar'], 'number'],
            [['IdStat'], 'integer'],
            [['TglInput'], 'safe'],
            [['Kode', 'NIS', 'KodePel'], 'string', 'max' => 18],
            [['Keterangan'], 'string', 'max' => 255],
            [['Kode'], 'exist', 'skipOnError' => true, 'targetClass' => Nilai::className(), 'targetAttribute' => ['Kode' => 'Kode']],
            [['IdStat'], 'exist', 'skipOnError' => true, 'targetClass' => NilaiStatus::className(), 'targetAttribute' => ['IdStat' => 'Id']],
            [['KodePel'], 'exist', 'skipOnError' => true, 'targetClass' => Pelajaran::className(), 'targetAttribute' => ['KodePel' => 'Kode']],
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
            'Kode' => 'Kode',
            'NIS' => 'Nis',
            'KodePel' => 'Kode Pel',
            'Nilai' => 'Nilai',
            'Standar' => 'Standar',
            'IdStat' => 'Id Stat',
            'TglInput' => 'Tgl Input',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Nilai::className(), ['Kode' => 'Kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(NilaiStatus::className(), ['Id' => 'IdStat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelajaran()
    {
        return $this->hasOne(Pelajaran::className(), ['Kode' => 'KodePel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswa()
    {
        return $this->hasOne(Siswa::className(), ['NIS' => 'NIS']);
    }
}
