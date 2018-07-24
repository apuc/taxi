<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "option_settings".
 *
 * @property int $id
 * @property string $table_name
 * @property int $table_row
 * @property string $key
 * @property string $value
 */
class OptionSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['table_row'], 'integer'],
            [['value'], 'string'],
            [['table_name', 'key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'table_row' => 'Table Row',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }
}
