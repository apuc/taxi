<?php

use backend\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View
 * @var $model User
 * @var $profile \backend\models\Profile
 *
 */

$this->title = 'Обновить ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        "profile" => $profile
    ]) ?>

</div>
