<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pegawai_biodata".
 *
 * @property integer $Id
 * @property string $IdPeg
 * @property string $Nama
 * @property string $GelarDepan
 * @property string $GelarBelakang
 * @property string $Alamat
 * @property string $Kota
 * @property integer $IdProv
 * @property integer $IdKab
 * @property string $KotaLahir
 * @property string $TglLahir
 * @property string $JK
 * @property string $Telepon
 * @property string $HP
 * @property string $Pos
 * @property string $Foto
 * @property string $Keterangan
 *
 * @property Kabupaten $idKab
 * @property Pegawai $idPeg
 * @property Provinsi $idProv
 */
class PegawaiBiodata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pegawai_biodata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdProv', 'IdKab','IdAgm','idGoldar'], 'integer'],
            [['TglLahir'], 'safe'],
            [['JK'], 'string'],
            [['IdPeg', 'GelarDepan', 'GelarBelakang', 'Telepon', 'HP'], 'string', 'max' => 18],
            [['Nama', 'Kota', 'KotaLahir'], 'string', 'max' => 100],
            [['Alamat', 'Foto', 'Keterangan'], 'string', 'max' => 255],
            [['Pos'], 'string', 'max' => 5],
			[['Foto'], 'file', 'extensions'=>'jpg, gif, png','skipOnEmpty' => true],
			[['IdProv', 'IdKab','TglLahir'],'required'],
            [['IdKab'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['IdKab' => 'Id']],
            [['IdPeg'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['IdPeg' => 'IdPeg']],
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
            'IdPeg' => 'Id Peg',
            'Nama' => 'Nama',
            'GelarDepan' => 'Gelar Depan',
            'GelarBelakang' => 'Gelar Belakang',
            'Alamat' => 'Alamat',
            'Kota' => 'Kota',
            'IdProv' => 'Id Prov',
			'IdAgm' => 'Id Agama',
			'idGoldar' => 'Id Goldar',
            'IdKab' => 'Id Kab',
            'KotaLahir' => 'Kota Lahir',
            'TglLahir' => 'Tgl Lahir',
            'JK' => 'Jk',
            'Telepon' => 'Telepon',
            'HP' => 'Hp',
            'Pos' => 'Pos',
            'Foto' => 'Foto',
            'Keterangan' => 'Keterangan',
        ];
    }

    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['Id' => 'IdKab']);
    }

    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['IdPeg' => 'IdPeg']);
    }

    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['Id' => 'IdProv']);
    }
	
	public function getAgama()
    {
        return $this->hasOne(Agama::className(), ['Id' => 'IdAgm']);
    }
	
	public function getGolonganDarah()
	{
		return $this->hasOne(GolonganDarah::className(), ['id' => 'idGoldar']);
	}

}
