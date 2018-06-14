<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14.06.18
 * Time: 10:57
 */

namespace backend\models;


class Country extends \common\models\Country {
	public function rules() {
		$rules = parent::rules();
		$rules[] =  [['name'], 'required', "message"=>"Обязательное поле"];
		return $rules;
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Название города',
		];
	}
}