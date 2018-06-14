<?php

use yii\db\Migration;

/**
 * Class m180614_074917_create_table_country
 */
class m180614_074917_create_table_country extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->createTable(
			"country",
			[
				"id"   => $this->primaryKey(),
				"name" => $this->string( 255 )
			]
		);

		$this->createIndex(
			"idx-city-country_id",
			"city",
			"country_id"
		);

		$this->addForeignKey(
			"fk-city-country_id",
			"city",
			"country_id",
			"country",
			"id"
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropForeignKey( "fk-city-country_id", "city" );
		$this->dropIndex( "idx-city-country_id", "city" );
		$this->dropTable( "country" );
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180614_074917_create_table_country cannot be reverted.\n";

		return false;
	}
	*/
}
