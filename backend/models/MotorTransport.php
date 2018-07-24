<?php

namespace backend\models;

use backend\models\User;
use Yii;

/**
 * This is the model class for table "motor_transport".
 *
 * @property string $id
 * @property string $user_id
 * @property string $brand
 * @property string $model
 * @property string $year
 * @property string $photo
 * @property string $status
 * @property string $dt_add
 */
class MotorTransport extends \common\models\MotorTransport
{
    public function rules() {
        $rules = parent::rules();
        $rules[] =  [['user_id', 'brand', 'model', 'year'], 'required', "message"=>"Обязательное поле"];
        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'user.username' => 'Имя пользователя',
            'brand' => 'Бренд',
            'model' => 'Модель',
            'year' => 'Год',
            'photo' => 'фото',
            'status' => 'Статус',
            'dt_add' => 'Дата добавления',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
