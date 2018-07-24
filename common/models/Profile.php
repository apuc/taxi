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
            [['user_id', 'created_at', 'updated_at', 'age', 'sex'], 'integer'],
            [['avatar', 'name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('profile', 'ID'),
            'user_id' => Yii::t('profile', 'User ID'),
            'avatar' => Yii::t('profile', 'Avatar'),
            'created_at' => Yii::t('profile', 'Created At'),
            'updated_at' => Yii::t('profile', 'Updated At'),
            'name' => Yii::t('profile', 'Name'),
            'age' => Yii::t('profile', 'Age'),
            'sex' => Yii::t('profile', 'Sex'),
            'phone' => Yii::t('profile', 'Phone'),
        ];
    }
}
