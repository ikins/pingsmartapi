<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "program_studi".
 *
 * @property integer $Id
 * @property string $ProgramStudi
 * @property integer $IdBidang
 *
 * @property Kompetensi[] $kompetensis
 * @property BidangStudi $idBidang
 */
class ProgramStudi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'program_studi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProgramStudi', 'IdBidang'], 'required'],
            [['IdBidang'], 'integer'],
            [['ProgramStudi'], 'string', 'max' => 255],
            [['IdBidang'], 'exist', 'skipOnError' => true, 'targetClass' => BidangStudi::className(), 'targetAttribute' => ['IdBidang' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'ProgramStudi' => 'Program Studi',
            'IdBidang' => 'Id Bidang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKompetensis()
    {
        return $this->hasMany(Kompetensi::className(), ['IdProdi' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidang()
    {
        return $this->hasOne(BidangStudi::className(), ['Id' => 'IdBidang']);
    }
}
