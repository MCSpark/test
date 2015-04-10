<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%doctor}}".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $full_doctor
 * @property string $age
 * @property string $sex
 * @property string $specialty
 *
 * @property DoctorToPatient[] $doctorToPatients
 * @property Patient[] $patients
 *
 * @property string $selectPatients
 */
class Doctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%doctor}}';
    }

    public function scenarios()
    {
        return [
            'default' => ['first_name', 'last_name', 'age', 'sex', 'specialty'],
            'assign' => ['patients'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'age', 'sex', 'specialty'], 'required'],
            [['first_name', 'last_name', 'specialty'], 'string', 'max' => 255],
            [['age', 'sex'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'first_name' => Yii::t('model', 'Имя'),
            'last_name' => Yii::t('model', 'Фамилия'),
            'age' => Yii::t('model', 'Возраст'),
            'sex' => Yii::t('model', 'Пол'),
            'specialty' => Yii::t('model', 'Специальность'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctorToPatients()
    {
        return $this->hasMany(DoctorToPatient::className(), ['doctor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatients()
    {
        return $this->hasMany(Patient::className(), ['id' => 'patient_id'])->viaTable('{{%doctor_to_patient}}', ['doctor_id' => 'id']);
    }
    public function setPatients($patients)
    {
        $this->patients = $patients;
    }

    public function getSelectPatients()
    {
        return Patient::find()->orderBy('last_name')->all();
    }

    public function getFull_Name()
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function getFull_Doctor($separator = ' :: ')
    {
        return $this->specialty . $separator . $this->full_name;
    }

    public function afterSave()
    {
        if ($this->scenario == 'assign') { $this->assignPatients(); }
    }

    public function assignPatients()
    {
        if(is_array($this->patients)) {
            DoctorToPatient::deleteAll(['doctor_id' => $this->id]);
            foreach ($this->patients as $patient) {
                $relation = new DoctorToPatient();
                $relation->doctor_id = $this->id;
                $relation->patient_id = $patient;
                $relation->save();
            }
            return true;
        }
        return false;
    }

}
