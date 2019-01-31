<?php

namespace common\models;

use Yii;
class Pengumuman extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengumuman';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tanggal', 'BeginPublish', 'EndPublish'], 'safe'],
            [['Pengumuman'], 'required'],
            [['Pengumuman'], 'string'],
            [['IdStat'], 'integer'],
            [['Judul'], 'string', 'max' => 160],
			[['IdPeg'], 'string', 'max' => 18],
            [['Keterangan'], 'string', 'max' => 255],
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
            'Judul' => 'Judul',
            'Pengumuman' => 'Pengumuman',
            'Target' => 'Target',
            'KodeKelas' => 'Kode Kelas',
            'IdStat' => 'Id Stat',
			'IdPeg' => 'IdPeg',
            'BeginPublish' => 'Begin Publish',
            'EndPublish' => 'End Publish',
            'Keterangan' => 'Keterangan',
        ];
    }
	
	public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['IdPeg' => 'IdPeg']);
    }
}
