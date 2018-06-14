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
        $this->createTable('request', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer(11)->notNull()->unsigned(),
            'status' => $this->integer(2)->defaultValue(0)->unsigned(),
            'type' => $this->string(255),
            'car_id' => $this->integer(11)->notNull()->unsigned(),
            'content' => $this->text(),
            'dt_add' => $this->integer(11)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('request');
    }
}
