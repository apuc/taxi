<?php

use backend\models\MotorTransport;
use backend\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model MotorTransport */

$this->title = $model->brand . " " . $model->model;
$this->params['breadcrumbs'][] = ['label' => 'Авто транспорт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motor-transport-view">

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
//            'user_id',
            [
                "attribute" => "user_id",
                "value" => function ($model) {
                    $user = User::findOne([$model->user_id]);
                    return ($user) ? $user->username : "Пользватель не найден";
                }
            ],
            'brand',
            'model',
            'year',
//            'photo',
            [
                "attribute" => "photo",
                "format" => "raw",
                "value" => function ($model) {
                    if (is_null($model->photo))  return "Фотография не загружена";
                    return Html::img($model->photo, ["width"=>200]);
                }
            ],
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
        ],
    ]) ?>

</div>
