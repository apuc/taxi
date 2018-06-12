<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 11.06.2018
 * Time: 13:37
 *
 * @var $modelAdd frontend\modules\api\models\AddRequest
 * @var $modelDelete frontend\modules\api\models\DeleteRequest
 * @var $modelEdit frontend\modules\api\models\EditRequest
 * @var $modelGetLists frontend\modules\api\models\GetLists
 * @var $token common\models\Token
 *
 *
 *
 */

?>

<?php

$modelAdd->token = ( $token ) ? $token->token : null;


$formAdd = \yii\widgets\ActiveForm::begin( [
	"action" => \yii\helpers\Url::to( [ "request/add" ] )
] );

echo $formAdd->field( $modelAdd, "token" )->hiddenInput()->label( false );

echo \yii\helpers\Html::submitInput( "отправить" );


\yii\widgets\ActiveForm::end();


$formDelete = \yii\widgets\ActiveForm::begin( [
	"action" => \yii\helpers\Url::to( [ "request/delete" ] )
] );

echo $formDelete->field( $modelDelete, "user_id" )->hiddenInput()->label( false );
echo $formDelete->field( $modelDelete, "token" )->hiddenInput()->label( false );
echo $formDelete->field( $modelDelete, "request_id" )->hiddenInput()->label( false );

echo \yii\helpers\Html::submitInput( "удалить" );
\yii\widgets\ActiveForm::end();


$formEdit = \yii\widgets\ActiveForm::begin( [
	"action" => \yii\helpers\Url::to( [ "request/edit" ] )
] );

echo $formEdit->field( $modelEdit, "user_id" )->hiddenInput()->label( false );
echo $formEdit->field( $modelEdit, "token" )->hiddenInput()->label( false );
echo $formEdit->field( $modelEdit, "request_id" )->hiddenInput()->label( false );

echo \yii\helpers\Html::submitInput( "Редактировать" );
\yii\widgets\ActiveForm::end();


$formGetLists = \yii\widgets\ActiveForm::begin( [
	"action" => \yii\helpers\Url::to( [ "request/get-lists" ] )
] );
echo $formGetLists->field( $modelGetLists, "user_id" )->hiddenInput()->label( false );
echo $formGetLists->field( $modelGetLists, "token" )->hiddenInput()->label( false );
echo $formGetLists->field( $modelGetLists, "offset" )->hiddenInput()->label( false );
echo $formGetLists->field( $modelGetLists, "limit" )->hiddenInput()->label( false );

echo \yii\helpers\Html::submitInput( "Получить список" );
\yii\widgets\ActiveForm::end();
?>
