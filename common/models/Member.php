<?php

namespace common\models;

use Yii;


class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MemberId'], 'string', 'max' => 18],
			[['KodePlan'], 'string', 'max' => 8],
            [['Nama'], 'string', 'max' => 160],
            [['Status'], 'string', 'max' => 255],
			[['IdStat', 'IdLev'], 'integer'],
            [['MemberId'], 'unique'],
			[['Avatar'], 'file', 'extensions'=>'jpg, gif, png','skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'MemberId' => 'Member ID',
			'Nama' => 'Nama',
			'IdStat' => 'Id Stat',
            'IdLev' => 'Id Lev',
            'Avatar' => 'Avatar',
			'Status' => 'Status',
			'KodePlan' => 'KodePlan',
        ];
    }

    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['Id' => 'IdProv']);
    }
	
	public function genKode()
	{
		$prefix=date('Y');
		$max = $this::find()->select('max(MemberId)')->andFilterWhere(['like','MemberId',$prefix])->scalar(); 
		
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
		
		return $this->MemberId=$id;
		
	}
	
	public function findByMemberId($mid)
	{
		//return $this::find()->where(['MemberId' => $mid])->one();
		return $this::findOne(['MemberId' => $mid]);
	}
	
	public function getUser()
    {
        return $this->hasOne(User::className(), ['MemberId' => 'MemberId']);
    }
	
	public function getLevel()
    {
        return $this->hasOne(MemberLevel::className(), ['Id' => 'IdLev']);
    }
	
	public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['MemberId' => 'MemberId']);
    }
	
	public function getSiswa()
    {
        return $this->hasOne(Siswa::className(), ['MemberId' => 'MemberId']);
    }
	
	public function getWali()
    {
        return $this->hasOne(Wali::className(), ['MemberId' => 'MemberId']);
    }
	
	public function getStatus()
    {
        return $this->hasOne(MemberStatus::className(), ['Id' => 'IdStat']);
    }
	
	public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['Kode' => 'KodePlan']);
    }
	
	public function SynchPeriode(){
		Yii::$app->db->createCommand("UPDATE member SET RemainPeriode=IFNULL(DATEDIFF(ExpiredDate,NOW()),0);")
		->execute();
	}
	
	public function CountRemain($id){
		Yii::$app->db->createCommand("UPDATE member SET RemainPeriode=IFNULL(DATEDIFF(ExpiredDate,NOW()),0) WHERE Id=:Id;")
		->bindValue(':Id',$id)
		->execute();
	}
	
}
