<?php

use yii\db\Migration;

class m161103_082310_create_lock_type_table extends Migration
{
    public function up()
    {
        $this->createTable('lock_type', [
            'id' => $this->primaryKey(),
            'description' => $this->string(32)->notNull(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_lock_type_created_by', 'lock_type', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_lock_type_updated_by', 'lock_type', 'updated_by', 'user', 'id');
		
        $this->createTable('lock_type_log', [
            'id' => $this->primaryKey(),
			'lock_type_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_lock_type_log_id', 'lock_type_log', 'lock_type_id', 'lock_type', 'id');
		$this->addForeignKey('fk_lock_type_log_updated_by', 'lock_type_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_lock_type_log_id', 'lock_type_log');
		$this->dropForeignKey('fk_lock_type_log_updated_by', 'lock_type_log');
		$this->dropTable('lock_type_log');
		
		$this->dropForeignKey('fk_lock_type_created_by', 'lock_type');
		$this->dropForeignKey('fk_lock_type_updated_by', 'lock_type');

        $this->dropTable('lock_type');
    }
}
