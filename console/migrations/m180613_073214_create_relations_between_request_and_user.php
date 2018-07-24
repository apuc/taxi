<?php

use yii\db\Migration;

/**
 * Class m180613_073214_create_relations_between_request_and_user
 */
class m180613_073214_create_relations_between_request_and_user extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$this->createIndex(
			"idx-request-user_id",
			"request",
			"user_id"
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {

		$this->dropIndex(
			"idx-request-user_id",
			"request"
		);
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180613_073214_create_relations_between_request_and_user cannot be reverted.\n";

		return false;
	}
	*/
}
