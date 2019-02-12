<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property integer $Id
 * @property string $NIS
 * @property string $NISN
 * @property string $KodeKelas
 * @property integer $ThnMasuk
 * @property integer $Point
 * @property string $Billing
 * @property integer $IsActive
 *
 * @property Kelas $kodeKelas
 * @property SiswaBiodata[] $siswaBiodatas
 * @property SiswaGaleri[] $siswaGaleris
 * @property SiswaGaleriAlbum[] $siswaGaleriAlbums
 * @property SiswaWali[] $siswaWalis
 */
class Siswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ThnMasuk', 'Point', 'IsActive'], 'integer'],
            [['Billing'], 'number'],
            [['NIS', 'NISN'], 'string', 'max' => 18],
            [['KodeKelas'], 'string', 'max' => 8],
			[['KodePel'], 'string'],
			[['idGoldar'], 'string'],
            [['NIS'], 'unique'],
			[['NIS', 'KodeKelas'], 'required'],
            [['KodeKelas'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['KodeKelas' => 'Kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'NIS' => 'Nomor Induk',
            'NISN' => 'Nisn',
            'KodeKelas' => 'Kode Kelas',
			'KodePel' => 'Kode Pelajaran',
            'ThnMasuk' => 'Thn Masuk',
            'Point' => 'Point',
            'Billing' => 'Billing',
            'IsActive' => 'Is Active',
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
    public function getBiodata()
    {
		
        return $this->hasOne(SiswaBiodata::className(), ['NIS' => 'NIS']);
    }
	
	

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGaleri()
    {
        return $this->hasMany(SiswaGaleri::className(), ['NIS' => 'NIS']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGaleriAlbum()
    {
        return $this->hasMany(SiswaGaleriAlbum::className(), ['NIS' => 'NIS']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswaWalis()
    {
        return $this->hasMany(SiswaWali::className(), ['NIS' => 'NIS']);
    }
	
	public function DemotePoint($nis,$point){
		Yii::$app->db->createCommand("UPDATE siswa SET Point = Point-:point WHERE NIS=:nis;")
		->bindValue(':nis', $nis)
		->bindValue(':point', $point)
		->execute();
	}
	
	public function SynchPoint($nis){
		Yii::$app->db->createCommand("UPDATE siswa SET Point = (SELECT SUM(Point) FROM siswa_records WHERE NIS=:nis) WHERE NIS=:nis;")
		->bindValue(':nis', $nis)
		->execute();
	}
	
	public function getMember()
    {
        return $this->hasOne(Member::className(), ['MemberId' => 'MemberId']);
    }
	
	
}
