<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Username', 'Password', 'Email'], 'required'],
            [['IdPriv', 'Created', 'LastUpdate','IsLogin'], 'integer'],
            [['Username', 'Password', 'PasswordResetToken', 'Email'], 'string', 'max' => 255],
            [['Authkey'], 'string', 'max' => 32],
            [['MemberId'], 'string', 'max' => 18],
            [['LastIP'], 'string', 'max' => 24],
            [['Username'], 'unique'],
            [['Email'], 'unique'],
            [['PasswordResetToken'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Username' => 'Username',
            'Authkey' => 'Authkey',
            'Password' => 'Password',
            'PasswordResetToken' => 'Password Reset Token',
            'Email' => 'Email',
            'IdPriv' => 'Id Priv',
            'MemberId' => 'Member ID',
            'Created' => 'Created',
            'LastUpdate' => 'Last Update',
            'LastIP' => 'Last Ip',
			'IsLogin' => 'IsLogin',
        ];
    }

    public function getPriviledges()
    {
        return $this->hasOne(UserPriviledges::className(), ['Id' => 'IdPriv']);
    }
	
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}
	
	public static function findIdentityByAccessToken($token,$type=null)
	{
		return static::findOne(['access_token'=>$token]);
	}
	
	public static function findByUsername($username)
	{
		return static::findOne(['Username'=>$username]);
	}
	
	public static function findbyPasswordResetToken($token)
	{
		$expire = \Yii::$app->params['user.PasswordResetTokenExpire'];
		$parts = explode('_',$token);
		$timestamp = (int) end($parts);
		if ($timestamp + $expire < time()){
			//token expired
			return null;
		}
		return static::findOne(['PasswordResetToken' => $token]);
	}
	
	public function getId()
	{
		return $this->getPrimaryKey();
	}
	
	public function getAuthKey()
	{
		return $this->Authkey;
	}
	
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey()==$authKey;
	}
	
	public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->Password);
    }
	
	public function setPassword($password)
    {
        $this->Password= Yii::$app->security->generatePasswordHash($password);
    }
	
	public function generateAuthKey()
    {
        $this->Authkey = Yii::$app->security->generateRandomString();
    }
	
	public function generatePasswordResetToken()
    {
        $this->PasswordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }
	
	public function removePasswordResetToken()
	{
		$this->PasswordResetToken = null;
	}
	
	public static function findByAuthKey($token)
	{
		
		return static::findOne(['AuthKey'=>$token,'Enabled' => 1]);
	}
		
	public function getMember(){
		return $this->hasOne(Member::className(), ['MemberId' => 'MemberId']);
	}
	
	public function setLoggedIn(){
		$this->IsLogin=1;
		$this->LastIP=Yii::$app->getRequest()->getUserIP();
		$this->save();
	}
	
	public function setLoggedOut(){
		$this->IsLogin=0;
		$this->save();
	}
}
