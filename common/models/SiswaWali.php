<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa_wali".
 *
 * @property integer $Id
 * @property string $NIS
 * @property integer $IdWali
 * @property integer $IdFam
 * @property integer $IsLive
 * @property string $Remarks
 *
 * @property FamilyStatus $idWali
 * @property Siswa $nIS
 */
class SiswaWali extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa_wali';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdFam', 'IsLive'], 'integer'],
            [['NIS','KodeWali'], 'string', 'max' => 18],
            [['Remarks'], 'string', 'max' => 255],
            [['IdFam'], 'exist', 'skipOnError' => true, 'targetClass' => FamilyStatus::className(), 'targetAttribute' => ['IdFam' => 'Id']],
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
            'NIS' => 'Nis',
            'KodeWali' => 'Kode Wali',
            'IdFam' => 'Id Fam',
            'IsLive' => 'Is Live',
            'Remarks' => 'Remarks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWali()
    {
        return $this->hasOne(Wali::className(), ['Kode' => 'KodeWali']);
    }
	
	public function getStatus()
    {
        return $this->hasOne(FamilyStatus::className(), ['Id' => 'IdFam']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswa()
    {
        return $this->hasOne(Siswa::className(), ['NIS' => 'NIS']);
    }
}
