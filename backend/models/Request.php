<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property string $id
 * @property string $user_id
 * @property string $status
 * @property string $type
 * @property string $car_id
 * @property string $content
 * @property string $dt_add
 * @property int $city_id
 */
class Request extends \common\models\Request
{
    public function rules()
    {
        return [
            [['user_id'], 'required', "message"=>"Обязательное поле"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'type' => 'Тип',
            'car_id' => 'Машина',
            'content' => 'Содержимое заявки',
            'dt_add' => 'Дата добавления',
            'city_id' => 'Город',
        ];
    }
}
