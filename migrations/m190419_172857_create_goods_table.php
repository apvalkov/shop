<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%goods}}`.
 */
class m190419_172857_create_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%goods}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'status' => $this->string()->notNull(),
            'title' => $this->string()->unique(),
            'description' => $this->text()->notNull(),
            'image' => $this->string(),
            'price' => $this->decimal(10, 2)->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createIndex('idx-goods-category-id', 'goods', 'category_id');

        $this->addForeignKey(
            'fk-goods-category-id',
            'goods',
            'category_id',
            'categories',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-goods-category-id','goods');
        $this->dropIndex('idx-goods-category-id', 'goods');
        $this->dropTable('{{%goods}}');
    }
}
