<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11.06.18
 * Time: 15:58
 */

namespace frontend\modules\api\models;

use common\helpers\Constants;
use common\models\Request;
use common\models\Token;

/**
 * Class AddRequest
 * @package frontend\modules\api\models
 *
 * класс для добавления новой записи в таблицу запросов
 */
class AddRequest extends ApiRequest {

	public $status;
	public $dt_add;
	public $content;
	public $type;
	public $car_id;


	public function rules() {
		$rules = parent::rules();

		$rules[] = [ [ "status", "dt_add", "car_id" ], "integer" ];
		$rules[] = [ [ 'content' ], 'string' ];
		$rules[] = [ [ 'type' ], 'string', 'max' => 255 ];

		return $rules;
	}


	/**
	 * добавление новой записи в таблице запросов
	 *
	 * @return bool
	 */
	public function save() {
		$model = new Request();

		$model->user_id = \Yii::$app->user->getId();
		$model->status  = Constants::STATUS_ENABLED;
		$model->type    = $this->type;
		$model->content = $this->content;
		$model->car_id  = $this->car_id;
		$model->dt_add  = time();

		//на время создания запросов валидация игнорируется
		return $model->save( false );
	}


}