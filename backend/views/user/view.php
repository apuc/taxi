<?php

use backend\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View
 * @var $model User
 * @var $profile \backend\models\Profile
 */
$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!--<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>-->
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


    <h2>Профиль</h2>
    <?= DetailView::widget([
        'model' => $profile,
        'attributes' => [
            [
                'attribute' => 'avatar',
                "format"=>"raw",
                'value' => function ($model) {
                    if (is_null($model->avatar)) return "Аватар не указан";
                    $img = Html::img($model->avatar);
                    return $img;
                }
            ],
            [
                'attribute' => 'name',
                "format"=>"raw",
                'value' => function ($model) {
                    if (is_null($model->name)) return "Имя не указано";
                    return $model->name;
                }
            ],
            [
                'attribute' => 'age',
                "format"=>"raw",
                'value' => function ($model) {
                    if (is_null($model->age)) return "Возраст не указан";
                    return $model->age;
                }
            ],
            [
                'attribute' => 'sex',
                "format"=>"raw",
                'value' => function ($model) {
                    if (is_null($model->sex)) return "Пол не указан";
                    if ($model->sex == 1) return "Мужской";
                    if ($model->sex == 0) return "Женский";
                }
            ],
            [
                'attribute' => 'phone',
                "format"=>"raw",
                'value' => function ($model) {
                    if (is_null($model->phone)) return "Телефон не указан";
                    return $model->phone;
                }
            ],
        ],
    ]) ?>

</div>
