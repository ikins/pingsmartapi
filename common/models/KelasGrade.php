<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kelas_grade".
 *
 * @property integer $Id
 * @property string $Grade
 *
 * @property Kelas[] $kelas
 */
class KelasGrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas_grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Grade'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Grade' => 'Grade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['IdGrade' => 'Id']);
    }
}
