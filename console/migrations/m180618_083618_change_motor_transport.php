<?php

use yii\db\Migration;

/**
 * Class m180618_083618_change_motor_transport
 */
class m180618_083618_change_motor_transport extends Migration
{
    public function safeUp() {
        $this->addColumn("motor_transport", "city_id", $this->integer(11)->notNull()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn("motor_transport", "city_id");
    }
}
