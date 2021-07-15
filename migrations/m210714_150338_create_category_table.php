<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m210714_150338_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(256)->notNull(),
        ]);

        $this->batchInsert('category', ['id', 'title'], [
            ['1', 'Одноместные'],
            ['2', 'Двуместные'],
            ['3', 'Люкс'],
            ['4', 'Де-Люкс'],
          ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
