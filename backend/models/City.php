<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.06.18
 * Time: 15:12
 */

namespace backend\models;

class City extends \common\models\City {

	public function rules() {
		$rules   = parent::rules();
		$rules[] = [ [ "name", "country_id" ], "required", "message" => "Это поле обязательно." ];

		return $rules;
	}


	public function attributeLabels() {
		return [
			'id'         => 'ID',
			'name'       => 'Имя',
			'slug'       => 'Slug',
			'dt_add'     => 'Дата создания',
			'country_id' => 'Страна',
		];
	}

}