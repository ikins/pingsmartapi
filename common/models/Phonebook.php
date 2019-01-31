<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vphonebook".
 *
 * @property string $Kode
 * @property string $Nama
 * @property string $HP
 * @property string $IdLev
 */
class Phonebook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vphonebook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kode', 'HP'], 'string', 'max' => 18],
            [['Nama'], 'string', 'max' => 160],
            [['IdLev'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kode' => 'Kode',
            'Nama' => 'Nama',
            'HP' => 'Hp',
            'IdLev' => 'Id Lev',
        ];
    }
}
