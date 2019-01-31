<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nilai_status".
 *
 * @property integer $Id
 * @property string $Status
 *
 * @property Nilai[] $nilais
 */
class NilaiStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nilai_status';
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
    public function getNilais()
    {
        return $this->hasMany(Nilai::className(), ['IdStat' => 'Id']);
    }
}
