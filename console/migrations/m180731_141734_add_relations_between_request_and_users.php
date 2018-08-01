<?php

use yii\db\Migration;

/**
 * Class m180731_141734_add_relations_between_request_and_users
 */
class m180731_141734_add_relations_between_request_and_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropIndex("idx-request-user_id", "request");

        $this->dropColumn("request", "user_id");
        $this->addColumn("request", "user_id", $this->integer());

        $this->createIndex(
            "idx-request-user_id",
            "request",
            "user_id"
        );

        $this->addForeignKey(
            "fk-request-user_id",
            "request",
            "user_id",
            "user",
            "id"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            "fk-request-user_id1",
            "request"
        );

        $this->dropIndex("idx-request-user_id", "request");

        $this->dropColumn("request", "user_id");

        $this->addColumn("request", "user_id", $this->integer()->unsigned());
        $this->createIndex(
            "idx-request-user_id",
            "request",
            "user_id"
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180731_141734_add_relations_between_request_and_users cannot be reverted.\n";

        return false;
    }
    */
}
