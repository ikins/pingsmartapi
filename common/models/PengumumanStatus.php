<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pengumuman_status".
 *
 * @property integer $Id
 * @property string $Status
 */
class PengumumanStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengumuman_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Status'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Status' => 'Status',
        ];
    }
}
