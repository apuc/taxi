<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $status
 * @property string $type
 * @property int $car_id
 * @property string $content
 * @property int $dt_add
 * @property int $city_id
 * @property int $parent_id
 * @property int $is_answer
 * @property int $user_id
 *
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'car_id', 'dt_add', 'city_id', 'parent_id', 'is_answer', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['dt_add'], 'required'],
            [['type'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('request', 'ID'),
            'user_id' => Yii::t('request', 'User ID'),
            'status' => Yii::t('request', 'Status'),
            'type' => Yii::t('request', 'Type'),
            'car_id' => Yii::t('request', 'Car ID'),
            'content' => Yii::t('request', 'Content'),
            'dt_add' => Yii::t('request', 'Dt Add'),
            'city_id' => Yii::t('request', 'City ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
