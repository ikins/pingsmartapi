<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelanggaran_kategori".
 *
 * @property integer $Id
 * @property string $Kategori
 *
 * @property Pelanggaran[] $pelanggarans
 */
class PelanggaranKategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelanggaran_kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kategori'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Kategori' => 'Kategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggarans()
    {
        return $this->hasMany(Pelanggaran::className(), ['IdKat' => 'Id']);
    }
}
