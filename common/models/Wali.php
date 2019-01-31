<?php

namespace common\models;

use Yii;

class Wali extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wali';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdKab', 'IdProv','IdJob'], 'integer'],
            [['Nama', 'Kota'], 'string', 'max' => 100],
            [['Alamat', 'Keterangan'], 'string', 'max' => 255],
            [['Pos'], 'string', 'max' => 5],
            [['Telepon'], 'string', 'max' => 20],
			[['Kode'], 'string', 'max' => 18],
			[['Kode'], 'unique'],
            [['HP'], 'string', 'max' => 16],
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
            'Nama' => 'Nama',
            'Alamat' => 'Alamat',
            'Kota' => 'Kota',
            'IdKab' => 'Id Kab',
            'IdProv' => 'Id Prov',
            'Pos' => 'Pos',
            'Telepon' => 'Telepon',
            'HP' => 'Hp',
			'IdJob' => 'IdJob',
        ];
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
	
	public function getPekerjaan()
    {
        return $this->hasOne(Pekerjaan::className(), ['Id' => 'IdJob']);
    }
	
	public function genKode()
	{
		$prefix=date('ym');
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
	
	public function getMember()
    {
        return $this->hasOne(Member::className(), ['MemberId' => 'MemberId']);
    }
}
