<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%link}}`.
 */
class m210702_141439_create_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%link}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->unique()->notNull(),
            'hash' => $this->string(10)->unique()->notNull(),
            'counter' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%link}}');
    }
}
