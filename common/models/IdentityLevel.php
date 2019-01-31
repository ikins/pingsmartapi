<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "identity_level".
 *
 * @property integer $Id
 * @property string $Level
 *
 * @property Identity[] $identities
 */
class IdentityLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'identity_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Level'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdentities()
    {
        return $this->hasMany(Identity::className(), ['IdLev' => 'Id']);
    }
}
