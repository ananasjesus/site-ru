<?php

use yii\db\Migration;

/**
 * Class m181109_132709_add_columns_for_auth
 */
class m181109_132709_add_columns_for_auth extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'email', $this->string()->notNull()->unique());
        $this->alterColumn('user', 'isAdmin', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('user', 'auth_key', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181109_132709_add_columns_for_auth cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181109_132709_add_columns_for_auth cannot be reverted.\n";

        return false;
    }
    */
}
