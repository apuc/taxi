<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View
 * @var $model \frontend\models\SignupForm
 */

?>
<h1>Add user</h1>


<?php $form = ActiveForm::begin( ); ?>

<?= $form->field( $model, 'username' )->textInput( [ 'autofocus' => true ] ) ?>

<?= $form->field( $model, 'email' ) ?>

<?= $form->field( $model, 'password' )->passwordInput() ?>

<div class="form-group">
	<?= Html::submitButton( 'Signup', [ 'class' => 'btn btn-primary', 'name' => 'signup-button' ] ) ?>
</div>

<?php ActiveForm::end(); ?>

