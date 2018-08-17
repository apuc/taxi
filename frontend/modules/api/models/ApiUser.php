<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $city_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class ApiUser extends \common\models\User
{
    //для пагинации
    public $offset;
    public $limit;


    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['username'], 'unique', 'message' => 'Такой username уже используется'];
        $rules[] = [['email'], 'unique', 'message' => 'Такой email уже используется'];
        $rules[] = [["offset", "limit", "status", "city_id"], "integer", "message" => "Поле должно быть числом"];
        $rules[] = [["offset"], "default", "value" => 0];
        $rules[] = [["limit"], "default", "value" => 20];
        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'username' => Yii::t('user', 'Username'),
            'auth_key' => Yii::t('user', 'Auth Key'),
            'password_hash' => Yii::t('user', 'Password Hash'),
            'password_reset_token' => Yii::t('user', 'Password Reset Token'),
            'email' => Yii::t('user', 'Email'),
            'status' => Yii::t('user', 'Status'),
            'created_at' => Yii::t('user', 'Created At'),
            'updated_at' => Yii::t('user', 'Updated At'),
        ];
    }
}
