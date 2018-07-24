<?php

use yii\db\Migration;

/**
 * Class m180613_112720_create_table_city
 */
class m180613_112720_create_table_city extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->createTable(
			"city",
			[
				"id"      => $this->primaryKey(),
				"name"    => $this->string( 255 ),
				"country" => $this->string( 255 ),
				"slug"    => $this->string( 255 ),
				"dt_add"  => $this->integer()
			]
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( "city" );
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180613_112720_create_table_city cannot be reverted.\n";

		return false;
	}
	*/
}
