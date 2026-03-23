<?php

use yii\db\Migration;

class m260323_234121_create_link extends Migration
{
    public function safeUp()
    {
        $this->createTable('link', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'short' => $this->string()->notNull(),
        ]);

        $this->createTable('log', [
            'id' => $this->primaryKey(),
            'link_id' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk_log_link',
            'log',
            'link_id',
            'link',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_log_link', 'log');
        $this->dropTable('link');
        $this->dropTable('log');
    }
}
