<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MotorTransport */

$this->title = 'Update Motor Transport: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Авто транспорт', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="motor-transport-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
