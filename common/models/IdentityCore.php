<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "identity_core".
 *
 * @property integer $Id
 * @property string $Core
 *
 * @property Identity[] $identities
 */
class IdentityCore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'identity_core';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Core'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Core' => 'Core',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdentities()
    {
        return $this->hasMany(Identity::className(), ['IdCore' => 'Id']);
    }
}
