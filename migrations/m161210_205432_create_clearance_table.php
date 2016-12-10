<?php

use yii\db\Migration;

class m161210_205432_create_clearance_table extends Migration
{
    public function up()
    {
        $this->createTable('tag', [
            'id' => $this->string(16)->notNull(),
        ]);
		$this->addPrimaryKey('pk_tag_id', 'tag', 'id');
		$this->addForeignKey('fk_tag_assignment_tag_id', 'tag_assignment', 'tag_id', 'tag', 'id');
		
       $this->createTable('clearance', [
            'id' => $this->primaryKey(),
            'door_id' => $this->integer()->notNull(),
            'tag_id' => $this->string(16)->notNull(),
			'start_date' => $this->datetime(),
			'end_date' => $this->datetime(),
        ]);
		$this->addForeignKey('fk_clearance_door_id', 'clearance', 'door_id', 'door', 'id');
		$this->addForeignKey('fk_clearance_tag_id', 'clearance', 'tag_id', 'tag', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_clearance_door_id', 'clearance');
		$this->dropForeignKey('fk_clearance_tag_id', 'clearance');
        $this->dropTable('clearance');
		
		$this->dropForeignKey('fk_tag_assignment_tag_id', 'tag_assignment');
		$this->dropPrimaryKey('pk_tag_id', 'tag');
        $this->dropTable('tag');
    }
}
