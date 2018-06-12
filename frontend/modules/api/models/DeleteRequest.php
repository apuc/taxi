<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11.06.18
 * Time: 17:25
 */

namespace frontend\modules\api\models;

use common\models\Request;

/**
 * Class DeleteRequest
 * @package frontend\modules\api\models
 * добавление записи в таблице запросов
 */
class DeleteRequest extends ApiRequest {

	public $user_id;
	public $request_id;

	public function rules() {

		$rules = parent::rules();

		$rules[] = [ [ "user_id" ], "integer" ];
		$rules[] = [ [ "request_id" ], "issetRequest" ];

		return $rules;
	}

	/**
	 * проверка, существует ли запись запроса
	 * @param $attribute
	 */
	public function issetRequest($attribute) {
		$request = Request::findOne($this->request_id);
		if (is_null($request)){
			$this->addError($attribute, "Ошибка запроса");
		}
	}

	/**
	 * @throws \Exception
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 * удаление записи из таблицы запроса
	 */
	public function deleteRequest(){
		$request = Request::findOne($this->request_id);

		$request->delete();
	}


}