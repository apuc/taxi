<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $dt_add
 * @property int $country_id
 *
 * @property Country $country
 */
class City extends \yii\db\ActiveRecord
{

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


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_add', 'country_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [["name"], "required", "message" => "Это поле обязательно"],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'dt_add' => 'Dt Add',
            'country_id' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
}
