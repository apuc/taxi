<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "options_settings_value".
 *
 * @property int $id
 * @property string $table_name
 * @property string $key
 * @property string $label
 * @property string $value
 */
class OptionsSettingsValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options_settings_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['table_name', 'key', 'label'], 'string', 'max' => 255],
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
            'key' => 'Key',
            'label' => 'Label',
            'value' => 'Value',
        ];
    }
}
