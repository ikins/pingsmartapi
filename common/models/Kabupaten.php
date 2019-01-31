<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kabupaten".
 *
 * @property integer $Id
 * @property string $Kabupaten
 * @property integer $IdProv
 *
 * @property Identity[] $identities
 * @property SiswaBiodata[] $siswaBiodatas
 * @property Wali[] $walis
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kabupaten';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kabupaten', 'IdProv'], 'required'],
            [['IdProv'], 'integer'],
            [['Kabupaten'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Kabupaten' => 'Kabupaten',
            'IdProv' => 'Id Prov',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdentities()
    {
        return $this->hasMany(Identity::className(), ['IdKab' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswaBiodatas()
    {
        return $this->hasMany(SiswaBiodata::className(), ['IdKabDom' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWalis()
    {
        return $this->hasMany(Wali::className(), ['IdKab' => 'Id']);
    }
}
