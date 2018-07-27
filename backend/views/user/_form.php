<?php

use backend\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(
        [
            User::STATUS_ACTIVE => "Активен",
            User::STATUS_DELETED => "Не активен"
        ]
    ) ?>

    <?= $form->field($model, 'city_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\City::find()->all(), "id", "name"),
        ["prompt" => ""]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
