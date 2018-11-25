<?php

use yii\db\Migration;

/**
 * Class m181125_143619_add_column_status_to_user_table
 */
class m181125_143619_add_column_status_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'status', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181125_143619_add_column_status_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181125_143619_add_column_status_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
