<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 11.06.2018
 * Time: 13:37
 *
 * @var $modelAdd frontend\modules\api\models\ApiRequest
 * @var $modelDelete frontend\modules\api\models\ApiRequest
 * @var $modelEdit frontend\modules\api\models\ApiRequest
 * @var $modelGetLists frontend\modules\api\models\ApiRequest
 * @var $token common\models\Token
 *
 *
 *
 */

?>

<?php
//$modelAdd->token = ( $token ) ? $token->token : null;
//var_dump($modelAdd);die;

$formAdd = \yii\widgets\ActiveForm::begin( [
	"action" => \yii\helpers\Url::to( [ "request/add" ] )
] );

echo \yii\helpers\Html::hiddenInput( "token", $token->token );

echo $formAdd->field( $modelAdd, "user_id" )->hiddenInput()->label( false );
echo $formAdd->field( $modelAdd, "car_id" )->hiddenInput()->label( false );
echo $formAdd->field( $modelAdd, "dt_add" )->hiddenInput()->label( false );

echo \yii\helpers\Html::submitInput( "Отправить" );


\yii\widgets\ActiveForm::end();


$formDelete = \yii\widgets\ActiveForm::begin( [
	"action" => \yii\helpers\Url::to( [ "request/delete" ] )
] );
echo \yii\helpers\Html::hiddenInput( "token", $token->token );
echo $formDelete->field( $modelDelete, "id" )->hiddenInput()->label( false );
echo \yii\helpers\Html::submitInput( "Удалить" );
\yii\widgets\ActiveForm::end();


$formEdit = \yii\widgets\ActiveForm::begin( [
	"action" => \yii\helpers\Url::to( [ "request/edit" ] )
] );
echo \yii\helpers\Html::hiddenInput( "token", $token->token );
echo $formEdit->field( $modelEdit, "id" )->hiddenInput()->label( false );
echo \yii\helpers\Html::submitInput( "Редактировать" );
\yii\widgets\ActiveForm::end();


$formGetLists = \yii\widgets\ActiveForm::begin( [
	"action" => \yii\helpers\Url::to( [ "request/get-lists" ] )
] );
echo \yii\helpers\Html::hiddenInput( "token", $token->token );
echo $formGetLists->field( $modelGetLists, "user_id" )->hiddenInput()->label( false );
echo $formGetLists->field( $modelGetLists, "limit" )->hiddenInput()->label( false );
echo $formGetLists->field( $modelGetLists, "offset" )->hiddenInput()->label( false );
echo \yii\helpers\Html::submitInput( "Получить все объекты" );
\yii\widgets\ActiveForm::end();


?>


