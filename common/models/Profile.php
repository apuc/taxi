<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $avatar
 * @property int $created_at
 * @property int $updated_at
 * @property string $name
 * @property int $age
 * @property int $sex
 * @property string $phone
 */
class Profile extends \yii\db\ActiveRecord
{
    const MEN = 1;
    const WOMEN = 2;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at', 'age', 'sex'], 'integer', "message"=>"Значение должно быть числом"],
            [['avatar', 'name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'avatar' =>'Аватар',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'name' => 'Имя',
            'age' => 'Возраст',
            'sex' => 'Пол',
            'phone' => "Телефон",
        ];
    }
}
