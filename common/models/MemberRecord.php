<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "member_record".
 *
 * @property integer $Id
 * @property string $Tanggal
 * @property string $MemberId
 * @property string $Kode
 * @property integer $Durasi
 * @property string $Harga
 * @property string $Expired
 * @property string $Keterangan
 *
 * @property Member $member
 * @property Plan $kode
 */
class MemberRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tanggal', 'Expired'], 'safe'],
            [['Durasi'], 'integer'],
            [['Harga'], 'number'],
            [['MemberId'], 'string', 'max' => 18],
            [['Kode'], 'string', 'max' => 8],
            [['Keterangan'], 'string', 'max' => 255],
            [['MemberId'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['MemberId' => 'MemberId']],
            [['Kode'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['Kode' => 'Kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Tanggal' => 'Tanggal',
            'MemberId' => 'Member ID',
            'Kode' => 'Kode',
            'Durasi' => 'Durasi',
            'Harga' => 'Harga',
            'Expired' => 'Expired',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['MemberId' => 'MemberId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['Kode' => 'Kode']);
    }
}
