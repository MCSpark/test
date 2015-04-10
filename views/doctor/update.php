<?php

use yii\widgets\Pjax;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Doctor */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Doctor',
]) . ' ' . $model->full_name;;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="doctor-update">

    <? Pjax::begin(['id'=>'Pjax-doctor', 'enablePushState'=>false]) ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <? Pjax::end() ?>

</div>
