<?php

use backend\models\MotorTransport;
use backend\models\User;
use common\models\OptionSettings;
use common\models\OptionsSettingsValue;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */
/* @var $form yii\widgets\ActiveForm */
$settings = OptionSettings::findOne([
    "table_name" => $model->tableName(),
    "table_row" => $model->id
]);

$settingsValue = json_decode($settings->value, true);
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(

        \yii\helpers\ArrayHelper::map(User::find()->all(), "id", "username"), ["prompt" => ""]

    ) ?>

    <?= $form->field($model, 'car_id')->dropDownList(

        \yii\helpers\ArrayHelper::map(MotorTransport::find()->all(), "id", "brand", "model"), ["prompt" => ""]

    ) ?>

    <?= $form->field($model, 'city_id')->dropDownList(

        \yii\helpers\ArrayHelper::map(\backend\models\City::find()->all(), "id", "name"), ["prompt" => ""]

    ) ?>

    <?= $form->field($model, 'status')->dropDownList(

        [
            \common\helpers\Constants::STATUS_ENABLED => "Активная",
            \common\helpers\Constants::STATUS_DISABLED => "Не активная"
        ]
    ) ?>

    <?= $form->field($model, 'type')->textInput() ?>
    <?= $form->field($model, 'content')->textarea() ?>

    <h2>Дополнительно</h2>

    <?php foreach ($settingsValue as $key => $item): ?>
        <?php $val = OptionsSettingsValue::findOne(["key" => $key]); ?>
        <div class="form-group field-request-content">
            <label class="control-label"><?= $val->label ?></label>
            <div style="display: flex; justify-content: space-between; align-items: center">
                <textarea class="form-control" name="OptionsSettingsValue[<?= $key ?>]"><?= trim($item) ?></textarea>

                <div class="remove">
                    <span class="btn btn-primary"><i class="fa fa-minus-circle" aria-hidden="true"></i></span>
                </div>
            </div>

        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .remove{
        padding-left: 30px;
    }
</style>