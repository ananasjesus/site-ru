<?php

use yii\db\Migration;

/**
 * Handles the creation of table `announcement`.
 */
class m181025_184908_create_announcement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('announcement', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('announcement');
    }
}
