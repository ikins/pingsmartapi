<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provinsi".
 *
 * @property integer $Id
 * @property string $Provinsi
 *
 * @property Destination[] $destinations
 * @property Member[] $members
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provinsi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Provinsi'], 'required'],
            [['Provinsi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Provinsi' => 'Provinsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestinations()
    {
        return $this->hasMany(Destination::className(), ['IdProv' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['IdProv' => 'Id']);
    }
}
