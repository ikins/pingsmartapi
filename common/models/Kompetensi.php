<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kompetensi".
 *
 * @property integer $Id
 * @property string $Kompetensi
 * @property integer $IdProdi
 *
 * @property Kelas[] $kelas
 * @property ProgramStudi $idProdi
 */
class Kompetensi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kompetensi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kompetensi', 'IdProdi'], 'required'],
            [['IdProdi'], 'integer'],
            [['Kompetensi'], 'string', 'max' => 255],
            [['IdProdi'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramStudi::className(), 'targetAttribute' => ['IdProdi' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Kompetensi' => 'Kompetensi',
            'IdProdi' => 'Id Prodi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['IdKom' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(ProgramStudi::className(), ['Id' => 'IdProdi']);
    }
}
