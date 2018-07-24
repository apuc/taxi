<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $type
 * @property int $car_id
 * @property string $content
 * @property int $dt_add
 * @property int $city_id
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
            [['type'] , 'required'],
            [['user_id', 'status', 'car_id', 'dt_add', 'city_id'], 'integer'],
            [['content'], 'string'],
            [["car_id"], "default", "value"=>0],
            [['type'], 'string', 'max' => 255],
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
}
