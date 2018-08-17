<?php

use backend\models\MotorTransport;
use backend\models\User;
use common\models\OptionSettings;
use common\models\OptionsSettingsValue;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View
 * @var $model backend\models\Request
 * @var $form yii\widgets\ActiveForm
 * @var $optionsSettingsValue [] OptionsSettingsValue
 */
$settings = OptionSettings::findOne([
    "table_name" => $model->tableName(),
    "table_row" => $model->id
]);

$settingsValue = ($settings) ? json_decode($settings->value, true) : null;
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
    <?php if ($settingsValue): ?>
        <?php foreach ($settingsValue as $key => $item): ?>
            <?php $val = OptionsSettingsValue::findOne(["key" => $key]); ?>
            <div class="form-group field-request-content">
                <div class="setting">
                    <div class="setting-item form-group">
                        <label class="control-label" style="width: 100%;"><?= $val->label ?></label>
                        <textarea class="form-control" style="width: calc(100% - 106px)"
                                  name="OptionsSettingsValue[<?= $key ?>]">
                        <?= trim($item) ?>
                    </textarea>

                        <div class="remove">
                            <span class="btn btn-primary"><i class="fa fa-minus-circle" aria-hidden="true"></i></span>
                        </div>
                    </div>

                </div>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <?php $val = new OptionsSettingsValue(); ?>
        <div class="form-group field-request-content">
            <div class="setting">

                <div class="setting-item form-group">
                    <label class="control-label" style="width: 100%;"><?= $val->label ?></label>
                    <textarea class="form-control" style="width: calc(100% - 106px)"
                              name="OptionsSettingsValue[]"></textarea>
                    <div class="remove">
                        <button type="button" class="btn btn-primary"><i class="fa fa-minus-circle"
                                                                         aria-hidden="true"></i></button>
                    </div>
                    <div class="plus">
                        <button type="button" data-toggle="modal" data-target="#setting" class="btn btn-primary"><i
                                class="fa fa-plus-circle"
                                aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>


        </div>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<ul class="hide" id="option-settings-value">
    <?php foreach ($optionsSettingsValue as $item): ?>
        <li class="id-<?= $item->id ?>">
            <span class="name"><?= $item->key ?></span>
            <span class="value"><?= $item->value ?></span>
        </li>
    <?php endforeach; ?>
</ul>

<?php
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Добавить опцию</h2>',
    'id' => 'setting',
]);

?>
<div class="form-group">
    <?php
    echo Html::label("Выберите существующую опцию или создайте свою");
    echo Html::dropDownList(
        'setting-dropdown-list',
        '',
        ArrayHelper::map($optionsSettingsValue, 'id', 'label'),
        ['class' => 'form-control']
    );
    ?>
</div>
<div class="form-group">
    <?php echo Html::label("Название новой опции"); ?>
    <?php echo Html::input('text', 'setting-input', '', ['class' => 'form-control']); ?>
</div>
<div class="form-group">
    <?php echo Html::label("Значение новой опции"); ?>
    <?php echo Html::textarea('setting-textarea', '', ['class' => 'form-control']); ?>
</div>
<div class="form-group">
    <button class="btn btn-primary" id="add-setting">Добавить опцию</button>
</div>

<?php Modal::end(); ?>

<style>
    .remove {
        padding: 0 15px;
    }

    .setting-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
</style>