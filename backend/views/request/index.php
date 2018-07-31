<?php

use backend\models\RequestSearch;
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View
 * @var $searchModel RequestSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Запросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    $user = \backend\models\Profile::findOne(["user_id" => $model->user_id]);
                    if (is_null($user)) return User::findOne($model->user_id)->username;
                    return $user->name;
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return ($model->status) ? "Активен" : "Не активен";
                }
            ],
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return ($model->type) ? $model->type : "Тип не прописан";
                }
            ],
            [
                'attribute' => 'car_id',
                'value' => function ($model) {
                    $car = \backend\models\MotorTransport::findOne($model->car_id);
                    if (is_null($car))   return "Машина не установлена";

                    return $car->brand . " " . $car->model;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
