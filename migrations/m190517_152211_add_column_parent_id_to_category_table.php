<?php

use yii\db\Migration;

/**
 * Class m190517_152211_add_column_parent_id_to_category_table
 */
class m190517_152211_add_column_parent_id_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('categories', 'parent_id', $this->integer()->after('id'));

        $this->createIndex('idx_category_parent_id', 'categories', 'parent_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_category_parent_id', 'categories');

        $this->dropColumn('categories', 'parent_id');
    }
}
