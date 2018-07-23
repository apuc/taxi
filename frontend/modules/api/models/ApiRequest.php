<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11.06.18
 * Time: 17:42
 */

namespace frontend\modules\api\models;


use common\helpers\Constants;
use common\models\Request;

/**
 * Class ApiRequest
 * @package frontend\modules\api\models
 * класс для работы с таблицей запросов в модуле api
 */
class ApiRequest extends Request {


	//для пагинации
	public $offset;
	public $limit;
	public $settings;


	public function rules() {
		$rules = parent::rules(); // TODO: Change the autogenerated stub

		$rules[] = [ [ "offset", "limit" ], "integer" ];
		$rules[] = [ [ "offset", "limit" ], "default", "value" => 2 ];
		return $rules;
	}
}