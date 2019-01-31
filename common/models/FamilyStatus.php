<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "family_status".
 *
 * @property integer $Id
 * @property string $Status
 *
 * @property SiswaWali[] $siswaWalis
 */
class FamilyStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'family_status';
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
    public function getSiswaWalis()
    {
        return $this->hasMany(SiswaWali::className(), ['IdWali' => 'Id']);
    }
}
