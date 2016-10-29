<?php

use yii\db\Migration;

class m161003_042804_create_room_table extends Migration
{
    public function up()
    {
        $this->createTable('room', [
            'id' => $this->primaryKey(),
			'floor_id' => $this->integer()->notNull(),
            'code' => $this->string(4)->notNull(),
            'name' => $this->string(32)->notNull(),
			'xpos' => $this->integer(),
			'ypos' => $this->integer(),
			'area' => $this->float(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_room_created_by', 'room', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_room_updated_by', 'room', 'updated_by', 'user', 'id');
		
		$this->addForeignKey('fk_room_floor_id', 'room', 'floor_id', 'floor', 'id');		
		
        $this->createTable('room_log', [
            'id' => $this->primaryKey(),
			'room_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_room_log_id', 'room_log', 'room_id', 'room', 'id');
		$this->addForeignKey('fk_room_log_updated_by', 'room_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_room_floor_id', 'room');		
		
		$this->dropForeignKey('fk_room_log_id', 'room_log');
		$this->dropForeignKey('fk_room_log_updated_by', 'room_log');
		$this->dropTable('room_log');
		
		$this->dropForeignKey('fk_room_created_by', 'room');
		$this->dropForeignKey('fk_room_updated_by', 'room');
        $this->dropTable('room');
    }
}
