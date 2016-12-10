<?php

use yii\db\Migration;

class m161210_195144_tag_assignment_table extends Migration
{
    public function up()
    {
        $this->createTable('tag_assignment', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->string(16)->notNull(),
			'person_id' => $this->integer()->notNull(),
			'tag_type_id' => $this->integer()->notNull(),
			'start_date' => $this->datetime()->notNull(),
			'end_date' => $this->datetime(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_tag_assignment_created_by', 'tag_assignment', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_tag_assignment_updated_by', 'tag_assignment', 'updated_by', 'user', 'id');
		$this->addForeignKey('fk_tag_assignment_person', 'tag_assignment', 'person_id', 'person', 'id');
		$this->addForeignKey('fk_tag_assignment_type', 'tag_assignment', 'tag_type_id', 'tag_type', 'id');
		
        $this->createTable('tag_assignment_log', [
            'id' => $this->primaryKey(),
			'tag_assignment_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_tag_assignment_log_id', 'tag_assignment_log', 'tag_assignment_id', 'tag_assignment', 'id');
		$this->addForeignKey('fk_tag_assignment_log_updated_by', 'tag_assignment_log', 'updated_by', 'user', 'id');

    }

    public function down()
    {
		$this->dropForeignKey('fk_tag_assignment_person', 'tag_assignment');
		$this->dropForeignKey('fk_tag_assignment_type', 'tag_assignment');
		$this->dropForeignKey('fk_tag_assignment_log_id', 'tag_assignment_log');
		$this->dropForeignKey('fk_tag_assignment_log_updated_by', 'tag_assignment_log');
		$this->dropTable('tag_assignment_log');
		
		$this->dropForeignKey('fk_tag_assignment_created_by', 'tag_assignment');
		$this->dropForeignKey('fk_tag_assignment_updated_by', 'tag_assignment');

        $this->dropTable('tag_assignment');
    }
}
