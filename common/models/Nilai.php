<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nilai".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Tanggal
 * @property integer $IdJenis
 * @property string $KodeKelas
 * @property string $IdPeg
 * @property string $Keterangan
 *
 * @property NilaiJenis $idJenis
 */
class Nilai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nilai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tanggal'], 'safe'],
            [['IdJenis'], 'integer'],
            [['Kode', 'KodeKelas', 'IdPeg','KodePel'], 'string', 'max' => 18],
            [['Keterangan'], 'string', 'max' => 255],
            [['Kode'], 'unique'],
            [['IdJenis'], 'exist', 'skipOnError' => true, 'targetClass' => NilaiJenis::className(), 'targetAttribute' => ['IdJenis' => 'Id']],
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
            'Tanggal' => 'Tanggal',
            'IdJenis' => 'Id Jenis',
            'KodeKelas' => 'Kode Kelas',
            'IdPeg' => 'Id Peg',
            'Keterangan' => 'Keterangan',
			'KodePel' => 'KodePel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis()
    {
        return $this->hasOne(NilaiJenis::className(), ['Id' => 'IdJenis']);
    }
	
	public function genKode($prefix)
	{
		$max = $this::find()->select('max(Kode)')->andFilterWhere(['like','Kode',$prefix])->scalar(); 
		
		if ($max != ''){
			$last=substr($max,5,8)+1;
			if($last<10){
				$id=$prefix.'000000'.$last;}
			elseif($last<100){
				$id=$prefix.'00000'.$last;}
			elseif($last<1000){
				$id=$prefix.'0000'.$last;}
			elseif($last<10000){
				$id=$prefix.'000'.$last;}
			elseif($last<100000){
				$id=$prefix.'00'.$last;}
			elseif($last<1000000){
				$id=$prefix.'0'.$last;}
			elseif($last<10000000){
				$id=$prefix.$last;}
		}
		else{
			$id=$prefix.'0000001';
		}
		
		return $this->Kode=$id;
		
	}
	
	public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['Kode' => 'KodeKelas']);
    }
	
	public function getPelajaran()
    {
        return $this->hasOne(Pelajaran::className(), ['Kode' => 'KodePel']);
    }
	
	public function getGuru()
    {
        return $this->hasOne(Pegawai::className(), ['IdPeg' => 'IdPeg']);
    }

}
