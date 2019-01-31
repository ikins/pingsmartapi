<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $Id
 * @property string $Tanggal
 * @property string $MemberId
 * @property string $InvNo
 * @property string $Jumlah
 * @property integer $IdPay
 * @property integer $IdStat
 * @property integer $IdBank
 * @property string $BankAsal
 * @property string $RekeningAsal
 * @property string $NamaRekAsal
 * @property string $Keterangan
 * @property string $Attachment
 *
 * @property Member $member
 * @property PaymentModel $idPay
 * @property PaymentStatus $idStat
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tanggal'], 'safe'],
            [['Jumlah'], 'number'],
            [['IdPay', 'IdStat', 'IdBank','IdType'], 'integer'],
            [['MemberId'], 'string', 'max' => 18],
            [['InvNo', 'BankAsal', 'RekeningAsal'], 'string', 'max' => 50],
            [['NamaRekAsal'], 'string', 'max' => 100],
            [['Keterangan', 'Attachment'], 'string', 'max' => 255],
            [['MemberId'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['MemberId' => 'MemberId']],
            [['IdPay'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentModel::className(), 'targetAttribute' => ['IdPay' => 'Id']],
            [['IdStat'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentStatus::className(), 'targetAttribute' => ['IdStat' => 'Id']],
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
            'InvNo' => 'Inv No',
            'Jumlah' => 'Jumlah',
            'IdPay' => 'Id Pay',
            'IdStat' => 'Id Stat',
            'IdBank' => 'Id Bank',
			'IdType' => 'Id Type',
            'BankAsal' => 'Bank Asal',
            'RekeningAsal' => 'Rekening Asal',
            'NamaRekAsal' => 'Nama Rek Asal',
            'Keterangan' => 'Keterangan',
            'Attachment' => 'Attachment',
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
    public function getModel()
    {
        return $this->hasOne(PaymentModel::className(), ['Id' => 'IdPay']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(PaymentStatus::className(), ['Id' => 'IdStat']);
    }
	
	public function getBank()
    {
        return $this->hasOne(BankAccount::className(), ['Id' => 'IdBank']);
    }
	
	public function getType()
    {
        return $this->hasOne(PaymentType::className(), ['Id' => 'IdType']);
    }
}
