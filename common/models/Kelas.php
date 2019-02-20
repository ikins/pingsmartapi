<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Kelas
 * @property integer $IdGrade
 * @property integer $IdJur
 * @property integer $IdKom
 * @property integer $Jumlah
 * @property string $IdWk
 *
 * @property Jadwal[] $jadwals
 * @property Jurusan $idJur
 * @property KelasGrade $idGrade
 * @property Kompetensi $idKom
 * @property Siswa[] $siswas
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdGrade', 'IdJur', 'IdKom', 'Jumlah','IdLev'], 'integer'],
            [['Kode'], 'string', 'max' => 8],
            [['Kelas'], 'string', 'max' => 15],
            [['IdWk'], 'string', 'max' => 18],
            [['Kode'], 'unique'],
            [['IdJur'], 'exist', 'skipOnError' => true, 'targetClass' => Jurusan::className(), 'targetAttribute' => ['IdJur' => 'Id']],
            [['IdGrade'], 'exist', 'skipOnError' => true, 'targetClass' => KelasGrade::className(), 'targetAttribute' => ['IdGrade' => 'Id']],
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
            'Kelas' => 'Kelas',
            'IdGrade' => 'Id Grade',
            'IdJur' => 'Id Jur',
            'IdKom' => 'Id Kom',
            'Jumlah' => 'Jumlah',
            'IdWk' => 'Id Wk',
			'IdLev' => 'Id Level'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['KodeKelas' => 'Kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurusan()
    {
        return $this->hasOne(Jurusan::className(), ['Id' => 'IdJur']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrade()
    {
        return $this->hasOne(KelasGrade::className(), ['Id' => 'IdGrade']);
    }
	
	public function getLevel()
    {
        return $this->hasOne(KelasLevel::className(), ['Id' => 'IdLev']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKompetensi()
    {
        return $this->hasOne(Kompetensi::className(), ['Id' => 'IdKom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['KodeKelas' => 'Kode']);
    }
	
	 public function getWali()
    {
        return $this->hasOne(Member::className(), ['MemberId' => 'IdWk']);
    }
	
	public static function getOptions(){
		$data=  static::find()->orderBy(['Kode'=>SORT_ASC])->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'Kode','Kelas'); //id = your ID model, name = your caption
		return $value;
	}
}
