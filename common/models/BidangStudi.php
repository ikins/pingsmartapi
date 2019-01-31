<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bidang_studi".
 *
 * @property integer $Id
 * @property string $Bidang
 *
 * @property ProgramStudi[] $programStudis
 */
class BidangStudi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidang_studi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Bidang'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Bidang' => 'Bidang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramStudis()
    {
        return $this->hasMany(ProgramStudi::className(), ['IdBidang' => 'Id']);
    }
}
