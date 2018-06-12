<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11.06.18
 * Time: 17:42
 */

namespace frontend\modules\api\models;


use common\models\Token;
use yii\base\Model;

/**
 * Class ApiRequest
 * @package frontend\modules\api\models
 * класс для работы с таблицей запросов в модуле api
 */
class ApiRequest  extends Model {

	public $token;

	public function rules() {
		return [
			[ [ "token" ], "string" ],
			[ [ "token" ], "validateToken" ],
		];
	}

	/**
	 * валидация токена
	 * @param $attribute
	 */
	public function validateToken( $attribute ) {
		$token = Token::findOne( [ "user_id" => \Yii::$app->user->identity->getId() ] );
		if ( $token->token != $this->token ) {
			return $this->addError( $attribute, "Время токена истекло. Переваторизируйтесь" );
		}
	}
}