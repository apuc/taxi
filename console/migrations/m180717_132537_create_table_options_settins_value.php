<?php

use yii\db\Migration;

/**
 * Class m180717_132537_create_table_options_settins_value
 */
class m180717_132537_create_table_options_settins_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("options_settings_value", [
            "id" => $this->primaryKey(),
            "table_name" => $this->string(255),
            "key" => $this->string(255),
            "label" => $this->string(255),
            "value" => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("options_settings_value");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180717_132537_create_table_options_settins_value cannot be reverted.\n";

        return false;
    }
    */
}
