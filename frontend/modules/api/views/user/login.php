<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */

?>
<h1>Login</h1>

<?= Html::beginForm(['login'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<p>Login</p>
<?= Html::input('text', 'login', Yii::$app->request->post('login'), ['class' => 'form-control']) ?>
<p>Password</p>
<?= Html::input('password', 'pass', Yii::$app->request->post('pass'), ['class' => 'form-control']) ?>
<p>
	<?= Html::submitButton('Send', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
</p>

