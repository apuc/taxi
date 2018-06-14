<?php

namespace backend\models;

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
class MotorTransport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motor_transport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'brand', 'model', 'year', 'dt_add'], 'required'],
            [['user_id', 'year', 'status', 'dt_add'], 'integer'],
            [['brand', 'model', 'photo'], 'string', 'max' => 254],
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
            'brand' => 'Brand',
            'model' => 'Model',
            'year' => 'Year',
            'photo' => 'Photo',
            'status' => 'Status',
            'dt_add' => 'Dt Add',
        ];
    }
}
