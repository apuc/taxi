<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12.06.18
 * Time: 4:51
 */

namespace frontend\modules\api\models;


use common\models\Request;

class GetLists extends ApiRequest {

	public $user_id;
	public $offset = 0;
	public $limit = 2;

	public function rules() {

		$rules = parent::rules();

		$rules[] = [ [ "user_id", "offset", "limit" ], "integer" ];

		return $rules;
	}


	/**
	 * @return array|\yii\db\ActiveRecord[]
	 * получить список записей из таблицы запросов
	 */
	public function getLists() {
		return Request::find()->where( [ "user_id" => $this->user_id ] )->offset( $this->offset )->limit( $this->limit )->asArray()->all();
	}

}