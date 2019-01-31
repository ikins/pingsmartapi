<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "identity".
 *
 * @property integer $Id
 * @property string $NPSN
 * @property string $Sekolah
 * @property integer $IdLev
 * @property integer $IdStat
 * @property integer $IdCore
 * @property string $Alamat
 * @property string $Kota
 * @property integer $IdKab
 * @property integer $IdProv
 * @property string $Telepon
 * @property string $HP
 * @property string $Email
 * @property string $Website
 * @property string $Logo
 *
 * @property IdentityCore $idCore
 * @property IdentityLevel $idLev
 * @property IdentityStatus $idStat
 * @property Kabupaten $idKab
 * @property Provinsi $idProv
 */
class Identity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'identity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdLev', 'IdStat', 'IdCore', 'IdKab', 'IdProv'], 'integer'],
            [['NPSN'], 'string', 'max' => 50],
            [['Sekolah'], 'string', 'max' => 100],
            [['Alamat', 'Logo'], 'string', 'max' => 255],
            [['Kota', 'Email', 'Website'], 'string', 'max' => 160],
            [['Telepon'], 'string', 'max' => 30],
            [['HP'], 'string', 'max' => 16],
            [['NPSN'], 'unique'],
            [['IdCore'], 'exist', 'skipOnError' => true, 'targetClass' => IdentityCore::className(), 'targetAttribute' => ['IdCore' => 'Id']],
            [['IdLev'], 'exist', 'skipOnError' => true, 'targetClass' => IdentityLevel::className(), 'targetAttribute' => ['IdLev' => 'Id']],
            [['IdStat'], 'exist', 'skipOnError' => true, 'targetClass' => IdentityStatus::className(), 'targetAttribute' => ['IdStat' => 'Id']],
            [['IdKab'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['IdKab' => 'Id']],
            [['IdProv'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['IdProv' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'NPSN' => 'Npsn',
            'Sekolah' => 'Sekolah',
            'IdLev' => 'Id Lev',
            'IdStat' => 'Id Stat',
            'IdCore' => 'Id Core',
            'Alamat' => 'Alamat',
            'Kota' => 'Kota',
            'IdKab' => 'Id Kab',
            'IdProv' => 'Id Prov',
            'Telepon' => 'Telepon',
            'HP' => 'Hp',
            'Email' => 'Email',
            'Website' => 'Website',
            'Logo' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCore()
    {
        return $this->hasOne(IdentityCore::className(), ['Id' => 'IdCore']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(IdentityLevel::className(), ['Id' => 'IdLev']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(IdentityStatus::className(), ['Id' => 'IdStat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['Id' => 'IdKab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['Id' => 'IdProv']);
    }
}
