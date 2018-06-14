<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.06.18
 * Time: 15:12
 */

namespace backend\models;

class City extends \common\models\City {

	public function behaviors() {
		return [
			'slug' => [
				'class'          => 'skeeks\yii2\slug\SlugBehavior',
				'slugAttribute'  => 'slug',                      //The attribute to be generated
				'attribute'      => 'name',                          //The attribute from which will be generated
				// optional params
				'maxLength'      => 64,                              //Maximum length of attribute slug
				'minLength'      => 3,                               //Min length of attribute slug
				'ensureUnique'   => true,
				'slugifyOptions' => [
					'lowercase' => true,
					'separator' => '-',
					'trim'      => true
					//'regexp' => '/([^A-Za-z0-9]|-)+/',
					//'rulesets' => ['russian'],
					//@see all options https://github.com/cocur/slugify
				]
			]
		];
	}

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