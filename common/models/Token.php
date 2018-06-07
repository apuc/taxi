<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property int $date_add
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'date_add'], 'required'],
            [['user_id', 'date_add'], 'integer'],
            [['token'], 'string', 'max' => 535],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('token', 'ID'),
            'user_id' => Yii::t('token', 'User ID'),
            'token' => Yii::t('token', 'Token'),
            'date_add' => Yii::t('token', 'Date Add'),
        ];
    }
}
