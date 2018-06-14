<?php

use yii\db\Migration;

/**
 * Class m180614_114313_motor_transport_table
 */
class m180614_114313_motor_transport_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('motor_transport', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'status' => $this->integer(2)->defaultValue(0),
            'type' => $this->string(255),
            'car_id' => $this->integer(11)->notNull(),
            'content' => $this->text(),
            'dt_add' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('motor_transport');
    }
}
