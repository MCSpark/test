<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%doctor_to_patient}}".
 *
 * @property integer $doctor_id
 * @property integer $patient_id
 *
 * @property Doctor $doctor
 * @property Patient $patient
 */
class DoctorToPatient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%doctor_to_patient}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'patient_id'], 'required'],
            [['doctor_id', 'patient_id'], 'integer'],

            [['doctor_id', 'patient_id'], 'unique', 'targetAttribute' => ['doctor_id', 'patient_id']]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }
}
