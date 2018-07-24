<?php

use yii\db\Migration;

/**
 * Class m180613_135508_add_column_city_id_in_user_and_request
 */
class m180613_135508_add_column_city_id_in_user_and_request extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->addColumn("user", "city_id", $this->integer());
    	$this->addColumn("request", "city_id", $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("user", "city_id");
	    $this->dropColumn("request", "city_id");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180613_135508_add_column_city_id_in_user_and_request cannot be reverted.\n";

        return false;
    }
    */
}
