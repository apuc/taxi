<?php

use yii\db\Migration;

/**
 * Class m180614_074544_change_city
 */
class m180614_074544_change_city extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->dropColumn( "city", "country" );
		$this->addColumn( "city", "country_id", $this->integer() );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->addColumn( "city", "country", $this->string( 255 ) );
		$this->dropColumn( "city", "country_id" );
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180614_074544_change_city cannot be reverted.\n";

		return false;
	}
	*/
}
