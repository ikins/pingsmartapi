<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property integer $Id
 * @property integer $UserId
 * @property string $Activity
 * @property string $IP
 * @property string $LoginTime
 * @property string $LogoutTime
 * @property string $ParentURL
 * @property integer $IdStat
 * @property string $Remark
 *
 * @property User $user
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId', 'IdStat'], 'integer'],
            [['LoginTime'], 'required'],
            [['LoginTime', 'LogoutTime'], 'safe'],
            [['Activity', 'Remark'], 'string', 'max' => 255],
            [['IP'], 'string', 'max' => 30],
            [['ParentURL'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
			['label' => 'Status','attribute' => 'articlesPublish.Publicity'],
            'UserId' => 'User ID',
            'Activity' => 'Activity',
            'IP' => 'IP Address',
            'LoginTime' => 'Action Time',
            'LogoutTime' => 'Logout Time',
            'ParentURL' => 'Parent Url',
            'IdStat' => 'Id Stat',
            'Remark' => 'Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['UserId' => 'UserId']);
    }
}
