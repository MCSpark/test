<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%patient}}".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $age
 * @property string $sex
 *
 * @property DoctorToPatient[] $doctorToPatients
 * @property Doctor[] $doctors
 *
 * @property string $selectDoctors
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%patient}}';
    }

    public function scenarios()
    {
        return [
            'default' => ['first_name', 'last_name', 'age', 'sex'],
            'assign' => ['doctors'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'age', 'sex'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctorToPatients()
    {
        return $this->hasMany(DoctorToPatient::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctors()
    {
        return $this->hasMany(Doctor::className(), ['id' => 'doctor_id'])
            ->viaTable('{{%doctor_to_patient}}', ['patient_id' => 'id'])
            ->orderBy(['specialty' => SORT_ASC]);
    }
    public function setDoctors($doctors)
    {
        $this->doctors = $doctors;
    }

    public function getSelectDoctors()
    {
        return Doctor::find()->orderBy(['specialty' => SORT_ASC, 'last_name' => SORT_ASC])->all();
    }

    public function getFull_Name()
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function afterSave()
    {
        if ($this->scenario == 'assign') { $this->assignDoctors(); }
    }

    public function assignDoctors()
    {
        if(is_array($this->doctors)) {
            DoctorToPatient::deleteAll(['patient_id' => $this->id]);
            foreach ($this->doctors as $doctor) {
                $relation = new DoctorToPatient();
                $relation->doctor_id = $doctor;
                $relation->patient_id = $this->id;
                $relation->save();
            }
            return true;
        }
        return false;
    }

}
