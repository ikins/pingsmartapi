<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "galery_album".
 *
 * @property integer $Id
 * @property string $Album
 * @property string $Cover
 * @property string $MemberId
 *
 * @property Member $member
 */
class GaleryAlbum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'galery_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Album'], 'string', 'max' => 100],
            [['Cover'], 'string', 'max' => 255],
            [['MemberId'], 'string', 'max' => 18],
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
            'Album' => 'Album',
            'Cover' => 'Cover',
            'MemberId' => 'Member ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['MemberId' => 'MemberId']);
    }
}
