<?php

use yii\db\Migration;

class m161210_162444_create_tag_type_table extends Migration
{
    public function up()
    {
        $this->createTable('tag_type', [
            'id' => $this->primaryKey(),
            'description' => $this->string(16)->notNull(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_tag_type_created_by', 'tag_type', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_tag_type_updated_by', 'tag_type', 'updated_by', 'user', 'id');
		
        $this->createTable('tag_type_log', [
            'id' => $this->primaryKey(),
			'tag_type_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_tag_type_log_id', 'tag_type_log', 'tag_type_id', 'tag_type', 'id');
		$this->addForeignKey('fk_tag_type_log_updated_by', 'tag_type_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_tag_type_log_id', 'tag_type_log');
		$this->dropForeignKey('fk_tag_type_log_updated_by', 'tag_type_log');
		$this->dropTable('tag_type_log');
		
		$this->dropForeignKey('fk_tag_type_created_by', 'tag_type');
		$this->dropForeignKey('fk_tag_type_updated_by', 'tag_type');

        $this->dropTable('tag_type');
    }
}
