<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_priviledges".
 *
 * @property integer $Id
 * @property string $Priviledges
 *
 * @property User[] $users
 */
class UserPriviledges extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_priviledges';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Priviledges'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Priviledges' => 'Priviledges',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['IdPriv' => 'Id']);
    }
}
