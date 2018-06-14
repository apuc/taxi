<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MotorTransport */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Авто транспорт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motor-transport-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'user_id',
            'brand',
            'model',
            'year',
            'photo',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == 0)
                        return 'Отключен';
                    else
                        return 'Активный';

                }
            ],
            [
                'attribute' => 'dt_add',
                'value' => function($model){
                    return date('d.m.Y', $model->dt_add);
                }
            ],
        ],
    ]) ?>

</div>
