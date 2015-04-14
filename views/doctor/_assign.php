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

        <div class="well well-sm">
            <fieldset style="height: 200px; overflow: auto">
                <?= $form->field($model, 'patients')->checkboxList(ArrayHelper::map($model->selectPatients, 'id', 'full_name' ), ['separator' => '<br>'])->label(false) ?>
            </fieldset>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['/doctor/view', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
