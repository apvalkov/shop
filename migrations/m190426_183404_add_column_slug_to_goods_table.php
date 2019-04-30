<?php

use yii\db\Migration;

/**
 * Class m190426_183404_add_column_slug_to_goods_table
 */
class m190426_183404_add_column_slug_to_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'goods',
            'slug',
            $this->string()->unique()->comment('Url товара')->after('title')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('goods', 'slug');
    }
}
