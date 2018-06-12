<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12.06.18
 * Time: 4:38
 */

namespace frontend\modules\api\models;


use common\models\Request;

class EditRequest extends ApiRequest {
	public $user_id;
	public $request_id;

	public function rules() {

		$rules = parent::rules();

		$rules[] = [ [ "user_id" ], "integer" ];
		$rules[] = [ [ "request_id" ], "issetRequest" ];

		return $rules;
	}

	/**
	 * @param $attribute
	 * проверка на существование записи в таблице запросов
	 */
	public function issetRequest( $attribute ) {
		$request = Request::findOne( $this->request_id );
		if ( is_null( $request ) ) {
			$this->addError( $attribute, "Ошибка запроса" );
		}
	}

	/**
	 * @return array
	 * получить запись из таблицы запросов
	 */
	public function getRequest() {
		return Request::findOne( $this->request_id )->toArray();
	}
}