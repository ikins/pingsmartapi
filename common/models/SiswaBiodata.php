<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa_biodata".
 *
 * @property integer $Id
 * @property string $NIS
 * @property string $Nama
 * @property string $JK
 * @property string $KotaLahir
 * @property string $TglLahir
 * @property integer $IdAgm
 * @property integer $idGoldar
 * @property string $Alamat
 * @property string $Kota
 * @property string $Telepon
 * @property integer $IdKab
 * @property integer $IdProv
 * @property string $Pos
 * @property integer $IdDom
 * @property string $AlamatDom
 * @property string $KotaDom
 * @property integer $IdKabDom
 * @property integer $IdProvDom
 * @property string $TeleponDom
 * @property string $Foto
 * @property string $Keterangan
 *
 * @property Agama $idAgm
 * @property Domisili $idDom
 * @property Kabupaten $idKabDom
 * @property Provinsi $idProvDom
 * @property Siswa $nIS
 */
class SiswaBiodata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa_biodata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['JK'], 'string'],
            [['TglLahir'], 'safe'],
            [['IdAgm', 'IdKab', 'IdProv', 'IdDom', 'IdKabDom', 'IdProvDom', 'idGoldar'], 'integer'],
            [['NIS'], 'string', 'max' => 18],
            [['Nama'], 'string', 'max' => 160],
            [['KotaLahir'], 'string', 'max' => 50],
            [['Alamat', 'AlamatDom', 'Foto', 'Keterangan'], 'string', 'max' => 255],
            [['Kota', 'KotaDom'], 'string', 'max' => 100],
            [['Telepon', 'TeleponDom'], 'string', 'max' => 20],
            [['Pos'], 'string', 'max' => 5],
			[['TglLahir','IdProv','IdDom','IdProvDom','IdKab','IdKabDom'], 'required'],
            [['IdAgm'], 'exist', 'skipOnError' => true, 'targetClass' => Agama::className(), 'targetAttribute' => ['IdAgm' => 'Id']],
			[['idGoldar'], 'exist', 'skipOnError' => true, 'targetClass' => GolonganDarah::className(), 'targetAttribute' => ['idGoldar' => 'id']],
            [['IdDom'], 'exist', 'skipOnError' => true, 'targetClass' => Domisili::className(), 'targetAttribute' => ['IdDom' => 'Id']],
            [['IdKabDom'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['IdKabDom' => 'Id']],
            [['IdProvDom'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['IdProvDom' => 'Id']],
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
            'Nama' => 'Nama',
            'JK' => 'Jk',
            'KotaLahir' => 'Kota Lahir',
            'TglLahir' => 'Tgl Lahir',
            'IdAgm' => 'Agama',
			'idGoldar' => 'Golongan Darah',
            'Alamat' => 'Alamat',
            'Kota' => 'Kota',
            'Telepon' => 'Telepon',
            'IdKab' => 'Kabupaten',
            'IdProv' => 'Provinsi',
            'Pos' => 'Pos',
            'IdDom' => 'Status Domisili',
            'AlamatDom' => 'Alamat Dom',
            'KotaDom' => 'Kota Dom',
            'IdKabDom' => 'Kabupaten Domisili',
            'IdProvDom' => 'Provinsi Domisili',
            'TeleponDom' => 'Telepon Dom',
            'Foto' => 'Avatar',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgama()
    {
        return $this->hasOne(Agama::className(), ['Id' => 'IdAgm']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getGolonganDarah()
    {
        return $this->hasOne(GolonganDarah::className(), ['id' => 'idGoldar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomisili()
    {
        return $this->hasOne(Domisili::className(), ['Id' => 'IdDom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomKab()
    {
        return $this->hasOne(Kabupaten::className(), ['Id' => 'IdKabDom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomProv()
    {
        return $this->hasOne(Provinsi::className(), ['Id' => 'IdProvDom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNIS()
    {
        return $this->hasOne(Siswa::className(), ['NIS' => 'NIS']);
    }
	
	public static function getOptions(){
		$data=  static::find()->orderBy(['Nama'=>SORT_ASC])->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'NIS','Nama'); //id = your ID model, name = your caption

		return $value;
	}
}
