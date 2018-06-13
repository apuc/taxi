<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "motor-transport".
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
class MotorTransport extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motor-transport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'brand', 'model', 'year'], 'required'],
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
            'id' => Yii::t('request', 'ID'),
            'user_id' => Yii::t('request', 'User ID'),
            'brand' => Yii::t('request', 'Brand'),
            'model' => Yii::t('request', 'Model'),
            'year' => Yii::t('request', 'Year'),
            'photo' => Yii::t('request', 'Photo'),
            'status' => Yii::t('request', 'Status'),
            'dt_add' => Yii::t('request', 'Dt Add'),
        ];
    }
}
