<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property integer $Id
 * @property string $IdPeg
 * @property string $NIP
 * @property integer $IdJab
 * @property integer $IdStat
 * @property string $MemberId
 *
 * @property Jabatan $idJab
 * @property Member $member
 * @property PegawaiBiodata[] $pegawaiBiodatas
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdJab', 'IdStat'], 'integer'],
            [['IdPeg', 'MemberId'], 'string', 'max' => 18],
            [['NIP'], 'string', 'max' => 25],
            [['IdPeg'], 'unique'],
			[['IdJab'], 'required'],
            [['IdJab'], 'exist', 'skipOnError' => true, 'targetClass' => Jabatan::className(), 'targetAttribute' => ['IdJab' => 'Id']],
            [['MemberId'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['MemberId' => 'MemberId']],
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
            'NIP' => 'Nip',
            'IdJab' => 'Id Jab',
            'IdStat' => 'Id Stat',
            'MemberId' => 'Member ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(Jabatan::className(), ['Id' => 'IdJab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['MemberId' => 'MemberId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiodata()
    {
        return $this->hasOne(PegawaiBiodata::className(), ['IdPeg' => 'IdPeg']);
    }
	
	public function genKode()
	{
		$prefix=date('Y');
		$max = $this::find()->select('max(IdPeg)')->andFilterWhere(['like','IdPeg',$prefix])->scalar(); 
		
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
		
		return $this->IdPeg=$id;
		
	}
}
