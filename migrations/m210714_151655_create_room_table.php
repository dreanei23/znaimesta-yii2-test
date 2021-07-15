<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m210714_151655_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(256)->notNull(),
            'category_id' => $this->integer()->defaultValue(1),
        ]);

        $this->addForeignKey(
            'fk-room-category_id',
            'room',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        $this->batchInsert('room', ['id', 'title', 'category_id'], [
            ['', 'Комната 1', '1'],
            ['', 'Комната 2', '1'],
            ['', 'Комната 3', '2'],
            ['', 'Комната 4', '2'],
            ['', 'Комната 5', '2'],
            ['', 'Комната 6', '2'],
            ['', 'Комната 7', '3'],
            ['', 'Комната 8', '3'],
            ['', 'Комната 9', '3'],
            ['', 'Комната 10', '4'],
            ['', 'Комната 11', '4'],
            ['', 'Комната 12', '4'],
            ['', 'Комната 13', '4'],
            ['', 'Комната 14', '4'],
          ]);
    }
    

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-room-category_id',
            'room'
        );

        $this->dropTable('{{%room}}');
    }
}
