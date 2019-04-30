<?php

use yii\db\Migration;

/**
 * Class m190426_173805_add_column_slug_to_categories_table
 */
class m190426_173805_add_column_slug_to_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'categories',
            'slug',
            $this->string()->unique()->comment('Url категории')->after('title')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('categories', 'slug');
    }
}
