<?php

use yii\db\Migration;

/**
 * Class m180725_141559_change_column_in_motor_transport
 */
class m180725_141559_change_column_in_motor_transport extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn("motor_transport", "city_id", $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn("motor_transport", "city_id", $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180725_141559_change_column_in_motor_transport cannot be reverted.\n";

        return false;
    }
    */
}
