<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jadwal".
 *
 * @property integer $Id
 * @property string $KodeKelas
 * @property string $KodePel
 * @property integer $IdJenis
 * @property integer $IdHari
 * @property string $JamMulai
 * @property string $JamAkhir
 * @property string $IdGuru
 * @property string $Keterangan
 *
 * @property JadwalJenis $idJenis
 * @property Kelas $kodeKelas
 * @property Pelajaran $kodePel
 */
class Jadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdJenis', 'IdHari'], 'integer'],
            [['JamMulai', 'JamAkhir'], 'required'],
            [['JamMulai', 'JamAkhir'], 'safe'],
            [['KodeKelas', 'KodePel'], 'string', 'max' => 8],
            [['IdGuru'], 'string', 'max' => 18],
            [['Keterangan'], 'string', 'max' => 255],
            [['IdJenis'], 'exist', 'skipOnError' => true, 'targetClass' => JadwalJenis::className(), 'targetAttribute' => ['IdJenis' => 'Id']],
            [['KodeKelas'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['KodeKelas' => 'Kode']],
            [['KodePel'], 'exist', 'skipOnError' => true, 'targetClass' => Pelajaran::className(), 'targetAttribute' => ['KodePel' => 'Kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'KodeKelas' => 'Kode Kelas',
            'KodePel' => 'Kode Pel',
            'IdJenis' => 'Id Jenis',
            'IdHari' => 'Id Hari',
            'JamMulai' => 'Jam Mulai',
            'JamAkhir' => 'Jam Akhir',
            'IdGuru' => 'Id Guru',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis()
    {
        return $this->hasOne(JadwalJenis::className(), ['Id' => 'IdJenis']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['Kode' => 'KodeKelas']);
    }
	
	public function getHari()
    {
        return $this->hasOne(Hari::className(), ['Id' => 'IdHari']);
    }
	
	public function getGuru()
    {
        return $this->hasOne(PegawaiBiodata::className(), ['IdPeg' => 'IdGuru']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelajaran()
    {
        return $this->hasOne(Pelajaran::className(), ['Kode' => 'KodePel']);
    }
	
	public function getNowSchedule($idguru, $timenow){
		$data=Jadwal::find()
        ->where(['<=', 'JamMulai', $timenow])
        ->andWhere(['>=', 'JamAkhir', $timenow])
        ->andWhere(['IdHari' => date('N') + 1])
        ->andFilterWhere(['IdGuru' => $idguru])->one();

		if ($data == null){
			return '-';
		}
		else{
			return $data->pelajaran->Pelajaran;
		}
		
	}
	
	public function getNextSchedule($idguru, $timenow){
		$data=Jadwal::find()
        ->andWhere(['>=', 'JamAkhir', $timenow])
        ->andWhere(['IdHari' => date('N') + 1])
        ->andFilterWhere(['IdGuru' => $idguru])->one();

        $jamTerkahir = $data['JamAkhir'];

        $dataNext=Jadwal::find()
        ->andWhere(['>', 'JamAkhir', $jamTerkahir])
        ->andWhere(['IdHari' => date('N') + 1])
        ->andFilterWhere(['IdGuru' => $idguru])->one();

		if ($dataNext == null){
			return '-';
		}
		else{
			return $dataNext->pelajaran->Pelajaran;
		}
		
	}
	
	public function getTeachingHour($idguru){

		$data=Jadwal::find()->where(['IdGuru' => $idguru, 'IdHari' => date('N') + 1])->all();
        if ($data == null){
            return '-';
        }
        else{
            
            $counthours = 0;

            foreach ($data as $row) {

                $first = date('Y-m-d').' '.$row->JamMulai;
                $start = strtotime($first);

                $second = date('Y-m-d').' '.$row->JamAkhir;
                $end = strtotime($second);

                $interval = $end - $start;

                $hours = floor($interval / 1800)/2;

                $counthours += $hours;

            }

            return $counthours;


        }

	}
}
