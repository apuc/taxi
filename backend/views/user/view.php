<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
//            'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return ($model->status == \backend\models\User::STATUS_ACTIVE) ? "Активен" : "Не активен";
                }
            ],
//            'created_at',
//            'updated_at',
            [
                'attribute' => 'city_id',
                'value' => function ($model) {
                    if (is_null($model->city_id)) return "Город не указан";
                    $city = \backend\models\City::findOne($model->city_id);
                    return $city->name;
                }
            ],
        ],
    ]) ?>

</div>
