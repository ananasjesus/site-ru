<?php

use yii\db\Migration;

/**
 * Class m181102_112717_fix_fk_junktion_tables
 */
class m181102_112717_fix_fk_junktion_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if (isset(Yii::$app->db->schema->getTableSchema('user_category')->columns['id']))
            $this->dropColumn('user_category', 'id');
        if (isset(Yii::$app->db->schema->getTableSchema('category_announcement')->columns['id']))
            $this->dropColumn('category_announcement', 'id');
        $this->addPrimaryKey('user_category_pk', 'user_category', ['user_id', 'category_id']);
        $this->addPrimaryKey('category_announcement_pk', 'category_announcement', ['category_id', 'announcement_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181102_112717_fix_fk_junktion_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181102_112717_fix_fk_junktion_tables cannot be reverted.\n";

        return false;
    }
    */
}
