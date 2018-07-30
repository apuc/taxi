<?php

use backend\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View
 * @var $model User
 * @var $profile \backend\models\Profile
 * @var $form yii\widgets\ActiveForm
 */
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

    <h2>Профиль</h2>

    <?php if ($profile->avatar): ?>
        <?= Html::img($profile->avatar) ?>
    <?php endif ?>


    <?= $form->field($profile, "file")->fileInput() ?>
    <?= $form->field($profile, "name")->textInput() ?>
    <?= $form->field($profile, "age")->textInput()?>
    <?= $form->field($profile, "sex")->dropDownList([
        "1" => "Мужской",
        "2" => "Женский"
    ])  ?>
    <?= $form->field($profile, "phone")->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+38 (999) 999 99 99',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
