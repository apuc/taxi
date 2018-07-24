<?php

use yii\db\Migration;

/**
 * Class m180614_131601_motor_transport_table
 */
class m180614_131601_motor_transport_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('motor_transport', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer(11)->notNull()->unsigned(),
            'brand' => $this->string(255)->notNull(),
            'model' => $this->string(255)->notNull(),
            'year' => $this->integer(11),
            'photo' => $this->string(255),
            'status' => $this->integer(2)->defaultValue(0)->unsigned(),
            'dt_add' => $this->integer(11)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('motor_transport');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180614_131601_motor_transport_table cannot be reverted.\n";

        return false;
    }
    */
}
