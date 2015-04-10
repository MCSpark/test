<?php

use yii\widgets\Pjax;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Patient',
]) . ' ' . $model->full_name;;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="patient-update">

    <? Pjax::begin(['id'=>'Pjax-patient', 'enablePushState'=>false]) ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <? Pjax::end() ?>

</div>
