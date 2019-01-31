<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "domisili".
 *
 * @property integer $Id
 * @property string $Status
 *
 * @property SiswaBiodata[] $siswaBiodatas
 */
class Domisili extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domisili';
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
    public function getSiswaBiodatas()
    {
        return $this->hasMany(SiswaBiodata::className(), ['IdDom' => 'Id']);
    }
}
