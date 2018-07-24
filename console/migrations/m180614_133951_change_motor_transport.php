<?php

use yii\db\Migration;

/**
 * Class m180614_133951_change_motor_transport
 */
class m180614_133951_change_motor_transport extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->dropColumn("motor_transport", "photo");
        $this->addColumn("motor_transport", "photo", $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn("motor_transport", "photo");
    }
}
