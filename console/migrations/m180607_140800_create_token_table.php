<?php

use yii\db\Migration;

/**
 * Handles the creation of table `token`.
 */
class m180607_140800_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('token', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer(11)->notNull()->unsigned(),
            'token' => $this->string(255),
            'date_add' => $this->integer(11)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('token');
    }
}
