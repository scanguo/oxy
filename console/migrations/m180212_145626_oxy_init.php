<?php

use yii\db\Migration;

class m180212_145626_oxy_init extends Migration
{
    public function up() {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer()->notNull()->defaultValue(0),
            'contact' => $this->integer()->notNull()->defaultValue(0),
            'cost' => $this->double()->notNull()->defaultValue(0),
            'income' => $this->double()->notNull()->defaultValue(0),
            'profit' => $this->double()->notNull()->defaultValue(0),
            'time' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created' => $this->integer()->notNull()->defaultValue(0),
            'updated' => $this->integer()->notNull()->defaultValue(0),
        ]);
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer()->notNull()->defaultValue(0),
            'project' => $this->integer()->notNull()->defaultValue(0),
            'io' => $this->integer()->notNull()->defaultValue(0),
            'type' => $this->integer()->notNull()->defaultValue(0),
            'contact' => $this->integer()->notNull()->defaultValue(0),
            'sum' => $this->double()->notNull()->defaultValue(0),
            'time' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created' => $this->integer()->notNull()->defaultValue(0),
            'updated' => $this->integer()->notNull()->defaultValue(0),
        ]);
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer()->notNull()->defaultValue(0),
            'type' => $this->integer()->notNull()->defaultValue(0),
            'name' => $this->string()->notNull()->defaultValue(''),
            'phone' => $this->string()->notNull()->defaultValue(''),
            'email' => $this->string()->notNull()->defaultValue(''),
            'remark' => $this->string()->notNull()->defaultValue(''),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created' => $this->integer()->notNull()->defaultValue(0),
            'updated' => $this->integer()->notNull()->defaultValue(0),
        ]);
        $this->createTable('{{%expend}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer()->notNull()->defaultValue(0),
            'contact' => $this->integer()->notNull()->defaultValue(0),
            'type' => $this->integer()->notNull()->defaultValue(0),
            'size' => $this->double()->notNull()->defaultValue(0),
            'unit' => $this->double()->notNull()->defaultValue(0),
            'sum' => $this->double()->notNull()->defaultValue(0),
            'time' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created' => $this->integer()->notNull()->defaultValue(0),
            'updated' => $this->integer()->notNull()->defaultValue(0),
        ]);
    }

    public function down() {
        $this->dropTable('{{%project}}');
        $this->dropTable('{{%task}}');
        $this->dropTable('{{%contact}}');
        $this->dropTable('{{%expend}}');
    }
}
