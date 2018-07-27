<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
?>
<div class="user-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
//            'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
//            'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return ($model->status == \backend\models\User::STATUS_ACTIVE) ? "Активен" : "Не активен";
                }
            ],
//            [
//                'attribute' => 'created_at',
//                'value' => function($model){
//                    return date('d.m.Y', $model->created_at);
//                }
//            ],
//            [
//                'attribute' => 'updated_at',
//                'value' => function($model){
//                    return date('d.m.Y', $model->updated_at);
//                }
//            ],
//            'city_id',
            [
                'attribute' => 'city_id',
                'value' => function ($model) {
                    if (is_null($model->city_id)) return "Город не указан";
                    $city = \backend\models\City::findOne($model->city_id);
                    return $city->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
