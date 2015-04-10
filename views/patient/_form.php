<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sex;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'age')->textInput(['maxlength' => 20]) ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'sex')->dropDownList(Sex::get(), ['prompt'=>'']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-pjax' => 'Pjax-patient']
        ) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $model->isNewRecord ? ['/patient/index'] : ['/patient/view', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
