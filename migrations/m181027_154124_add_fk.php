<?php

use yii\db\Migration;

/**
 * Class m181027_154124_add_fk
 */
class m181027_154124_add_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add foreign key for table 'user'
        $this->createIndex(
            'idx_user_category_user_id',
            'user_category',
            'user_id'
        );

        $this->addForeignKey(
            'fk_user_category_user_id',
            'user_category',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_user_category_category_id',
            'user_category',
            'category_id'
        );

        $this->addForeignKey(
            'fk_user_category_category_id',
            'user_category',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181027_154124_add_fk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181027_154124_add_fk cannot be reverted.\n";

        return false;
    }
    */
}
