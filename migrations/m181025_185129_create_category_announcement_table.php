<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_announcement`.
 */
class m181025_185129_create_category_announcement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_announcement', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'announcement_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category_announcement');
    }
}
