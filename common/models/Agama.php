<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agama".
 *
 * @property integer $Id
 * @property string $Agama
 *
 * @property SiswaBiodata[] $siswaBiodatas
 */
class Agama extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agama';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Agama'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Agama' => 'Agama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswa()
    {
        return $this->hasMany(SiswaBiodata::className(), ['IdAgm' => 'Id']);
    }
}
