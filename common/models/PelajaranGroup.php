<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelajaran_group".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Group
 *
 * @property Pelajaran[] $pelajarans
 */
class PelajaranGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelajaran_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kode'], 'string', 'max' => 5],
            [['Group'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Kode' => 'Kode',
            'Group' => 'Group',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelajarans()
    {
        return $this->hasMany(Pelajaran::className(), ['IdGroup' => 'Id']);
    }
}
