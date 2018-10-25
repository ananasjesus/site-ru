<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_category`.
 */
class m181025_185106_create_user_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_category', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_category');
    }
}
