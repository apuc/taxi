<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */

?>
<h1>Add user</h1>


<?= Html::beginForm(['add'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<p>Login</p>
<?= Html::input('text', 'login', Yii::$app->request->post('login'), ['class' => 'form-control']) ?>
<p>Email</p>
<?= Html::input('text', 'email', Yii::$app->request->post('email'), ['class' => 'form-control']) ?>
<p>Password</p>
<?= Html::input('text', 'pass', Yii::$app->request->post('pass'), ['class' => 'form-control']) ?>
<p>
	<?= Html::submitButton('Send', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
</p>

