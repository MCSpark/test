<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Sex;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a(Yii::t('app', 'Create Patient'), ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'last_name',
            'first_name',
            'age',
            [
                'attribute' => 'sex',
                'value' => function ($model) {
                    return Sex::get($model->sex);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel, 'sex', Sex::get(),
                    ['class' => 'form-control', 'prompt' => '']
                ),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
            ],
        ],
    ]); ?>

</div>
