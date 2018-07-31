<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */

$this->title = 'Обновить запрос: ';
$this->params['breadcrumbs'][] = ['label' => 'Запрос', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="request-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
