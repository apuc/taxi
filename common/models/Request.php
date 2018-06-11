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
            [['user_id', 'car_id', 'dt_add'], 'required'],
            [['user_id', 'status', 'car_id', 'dt_add'], 'integer'],
            [['content'], 'string'],
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
        ];
    }
}
