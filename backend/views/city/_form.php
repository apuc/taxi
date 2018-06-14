<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    <?//= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>-->

<!--    <?//= $form->field($model, 'dt_add')->textInput() ?>-->

    <?= $form->field($model, 'country_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(\common\models\Country::find()->all(), "id", "name"),
            ["prompt"=>""]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
