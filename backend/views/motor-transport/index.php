<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\User;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MotorTransportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Автотранспорт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motor-transport-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить автотранспотрт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'user_id',
            [
                'attribute' => 'user.username',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'name' => 'MotorTransportSearch[user_id]',
                    'data' => ArrayHelper::map($users, 'id', 'username'),
                    'options' => ['placeholder' => 'Введите имя ...',],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                "value" => function ($model) {
                    if ($model->user){
                        return $model->user->username;
                    }
                    return "Имя не назначено";
                }
            ],
            'brand',
            'model',
            'year',
//            'photo',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == 0)
                        return 'Отключен';
                    else
                        return 'Активный';

                }
            ],
            [
                'attribute' => 'dt_add',
                'value' => function ($model) {
                    return date('d.m.Y', $model->dt_add);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
