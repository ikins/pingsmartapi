<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "member_level".
 *
 * @property integer $Id
 * @property string $Level
 *
 * @property Member[] $members
 */
class MemberLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Level'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['IdLev' => 'Id']);
    }
	
	public static function getOptions(){
		$data=  static::find()->orderBy(['Id'=>SORT_ASC])->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'Id','Level'); //id = your ID model, name = your caption

		return $value;
	}
	
	
}
