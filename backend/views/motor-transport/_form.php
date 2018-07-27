<?php

use backend\models\MotorTransport;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model MotorTransport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="motor-transport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>
    <?php if (!empty($model->photo)): ?>
        <?= Html::img($model->photo, ["width"=>200]);?>
    <?php endif; ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1' => 'Активный',
        '0' => 'Отключен',
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
