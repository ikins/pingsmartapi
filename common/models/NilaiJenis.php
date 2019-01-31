<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nilai_jenis".
 *
 * @property integer $Id
 * @property string $Jenis
 *
 * @property Nilai[] $nilais
 */
class NilaiJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nilai_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Jenis'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Jenis' => 'Jenis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNilais()
    {
        return $this->hasMany(Nilai::className(), ['IdJenis' => 'Id']);
    }
}
