<?php

use yii\db\Migration;

/**
 * Class m180717_110925_create_table_option_settings
 */
class m180717_110925_create_table_option_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("option_settings", [
            "id" => $this->primaryKey(),
            "table_name" => $this->string(255),
            "table_row" => $this->integer(),
            "key" => $this->string(255),
            "value" => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("option_settings");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180717_110925_create_table_option_settings cannot be reverted.\n";

        return false;
    }
    */
}
