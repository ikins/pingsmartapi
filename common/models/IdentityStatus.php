<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "identity_status".
 *
 * @property integer $Id
 * @property string $Status
 *
 * @property Identity[] $identities
 */
class IdentityStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'identity_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Status'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdentities()
    {
        return $this->hasMany(Identity::className(), ['IdStat' => 'Id']);
    }
}
