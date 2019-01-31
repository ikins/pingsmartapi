<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "galery".
 *
 * @property integer $Id
 * @property string $MemberId
 * @property string $Judul
 * @property integer $IdAlb
 * @property string $Deskripsi
 * @property string $Image
 * @property integer $IsShown
 * @property string $UploadTime
 *
 * @property Member $member
 */
class Galery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'galery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdAlb', 'IdStat'], 'integer'],
            [['UploadTime','OperationTime'], 'safe'],
            [['MemberId','ModID'], 'string', 'max' => 18],
            [['Judul','Remarks'], 'string', 'max' => 100],
            [['Deskripsi', 'Image'], 'string', 'max' => 255],
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
            'MemberId' => 'Member ID',
            'Judul' => 'Judul',
            'IdAlb' => 'Id Alb',
            'Deskripsi' => 'Deskripsi',
            'Image' => 'Image',
            'IdStat' => 'Id Stat',
            'UploadTime' => 'Upload Time',
			'OperationTime' => 'OperationTime',
			'ModID' => 'ModID',
			'Remarks' => 'Remarks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['MemberId' => 'MemberId']);
    }
	
	public function getAlbum()
    {
        return $this->hasOne(GaleryAlbum::className(), ['Id' => 'IdAlb']);
    }
	
	public function getStatus()
    {
        return $this->hasOne(GaleryStatus::className(), ['Id' => 'IdStat']);
    }
	
	public function getModerator()
    {
        return $this->hasOne(Member::className(), ['MemberId' => 'ModId']);
    }
}
