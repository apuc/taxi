<?php

use yii\db\Migration;

/**
 * Handles the creation of table `request`.
 */
class m180610_201612_create_request_table extends Migration
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
