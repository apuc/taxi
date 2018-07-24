<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MotorTransport */

$this->title = 'Create Motor Transport';
$this->params['breadcrumbs'][] = ['label' => 'Авто транспорт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motor-transport-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
