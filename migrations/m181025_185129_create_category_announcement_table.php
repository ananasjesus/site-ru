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
