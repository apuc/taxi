<?php

use yii\db\Migration;

/**
 * Class m180725_112649_add_column_parent_id_to_request_table
 */
class m180725_112649_add_column_parent_id_to_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("request", "parent_id", $this->integer());
        $this->addColumn("request", "is_answer", $this->boolean());
        $this->alterColumn("request", "car_id", $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("request", "parent_id");
        $this->dropColumn("request", "is_answer");
        $this->alterColumn("request", "car_id", $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180725_112649_add_column_parent_id_to_request_table cannot be reverted.\n";

        return false;
    }
    */
}
