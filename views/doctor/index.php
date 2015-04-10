<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Sex;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DoctorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Doctors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a(Yii::t('app', 'Create Doctor'), ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'specialty',
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
