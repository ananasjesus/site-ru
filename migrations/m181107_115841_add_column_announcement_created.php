<?php

use yii\db\Migration;

/**
 * Class m181107_115841_add_column_announcement_created
 */
class m181107_115841_add_column_announcement_created extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('announcement', 'created', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181107_115841_add_column_announcement_created cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181107_115841_add_column_announcement_created cannot be reverted.\n";

        return false;
    }
    */
}
