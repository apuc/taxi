<?php

use backend\models\User;
use common\models\OptionSettings;
use common\models\OptionsSettingsValue;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */

$title = \backend\models\Profile::findOne(["user_id" => $model->user_id]);
$this->title = (!is_null($title)) ? $title->name : User::findOne($model->user_id)->username;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-view">

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
                    if (is_null($car)) return "Машина не установлена";

                    return $car->brand . " " . $car->model;
                }
            ],
            [
                'attribute' => 'content',
                'value' => function ($model) {
                    return ($model->content) ? $model->content : "Содержимое не прописано";
                }
            ],
            [
                'attribute' => 'dt_add',
                'value' => function ($model) {
                    return date("Y-m-d", $model->dt_add);
                }
            ],
            [
                'attribute' => 'city_id',
                'value' => function ($model) {
                    $city = \backend\models\City::findOne($model->city_id);
                    if (is_null($city)) return "Машина не указана";
                    return $city->name;
                }
            ],
            [
                'attribute' => 'Дополнительно',
                "format" => "html",
                'value' => function ($model) {
                    /**
                     * @var $model backend\models\Request
                     */
                    $settings = OptionSettings::findOne([
                        "table_name" => $model->tableName(),
                        "table_row" => $model->id
                    ]);
                    $result = "";
                    if ($settings) {
                        $value = json_decode($settings->value, true);
                        foreach ($value as $key => $item) {
                            $valueSettings = OptionsSettingsValue::findOne(["key" => $key]);
                            $result .= $valueSettings->label . " " . $valueSettings->value . "<br>";
                        }
                    }
                    return $result;
                }
            ]
        ],
    ]) ?>

</div>
