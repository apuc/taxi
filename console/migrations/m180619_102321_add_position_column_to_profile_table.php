<?php

use yii\db\Migration;

/**
 * Handles adding position to table `profile`.
 */
class m180619_102321_add_position_column_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('profile', 'name', $this->string());
        $this->addColumn('profile', 'age', $this->integer()->unsigned());
        $this->addColumn('profile', 'sex', $this->tinyInteger()->unsigned());
        $this->addColumn('profile', 'phone', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('profile', 'name');
        $this->dropColumn('profile', 'age');
        $this->dropColumn('profile', 'sex');
        $this->dropColumn('profile', 'phone');
    }
}
