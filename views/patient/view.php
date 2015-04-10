<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Sex;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">

    <? Pjax::begin(['id'=>'Pjax-patient', 'enablePushState'=>false]) ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'data-pjax' => 'Pjax-patient']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['/doctor/index'], ['class' => 'btn btn-default pull-right']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'last_name',
            'age',
            [
                'attribute' => 'sex',
                'value' => Sex::get($model->sex),
            ],
        ],
    ]) ?>

    <div class="row">
        <div class="col-xs-3">
            <strong>Наблюдается у врача:</strong>
        </div>
        <div class="col-xs-6">
            <? if (Yii::$app->controller->action->id == 'assign') {
                echo $this->render('_assign', ['model' => $model]);
            } else {
                foreach ($model->doctors as $doctor) {
                    $name = Html::tag('span', $doctor->full_doctor, ['class' => 'text-info']);
                    echo nl2br(Html::a($name, ['/doctor/view', 'id' => $doctor->id]) . "\n");
                }
                echo Html::a('Лечащий врач', ['/patient/assign','id'=>$model->id], ['class' => 'btn btn-info', 'style'=>'margin-top:20px;']);
            } ?>
        </div>
    </div>

    <? Pjax::end() ?>

</div>
