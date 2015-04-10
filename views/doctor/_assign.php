<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Doctor */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'patients')->dropDownList(ArrayHelper::map($model->selectPatients, 'id', 'full_name' ), ['size'=>10, 'multiple' => true])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['/doctor/view', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
