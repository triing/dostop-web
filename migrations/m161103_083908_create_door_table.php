<?php

use yii\db\Migration;

class m161103_083908_create_door_table extends Migration
{
    public function up()
    {
        $this->createTable('door', [
            'id' => $this->primaryKey(),
			'to_room_id' => $this->integer()->notNull(),
			'from_room_id' => $this->integer(),
			'lock_type_id' => $this->integer()->notNull(),
            'secret' => $this->string(255)->notNull(),
			'preference' => $this->float()->notNull()->defaultValue(1.00),
			'xpos' => $this->integer(),
			'ypos' => $this->integer(),
            'direction' => $this->string(2),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		
		$this->addForeignKey('fk_door_to_room_id', 'door', 'to_room_id', 'room', 'id');		
		$this->addForeignKey('fk_door_from_room_id', 'door', 'from_room_id', 'room', 'id');		
		$this->addForeignKey('fk_door_lock_type_id', 'door', 'lock_type_id', 'lock_type', 'id');		
		
		$this->addForeignKey('fk_door_created_by', 'door', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_door_updated_by', 'door', 'updated_by', 'user', 'id');
		
        $this->createTable('door_log', [
            'id' => $this->primaryKey(),
			'door_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_door_log_id', 'door_log', 'door_id', 'door', 'id');
		$this->addForeignKey('fk_door_log_updated_by', 'door_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_door_to_room_id', 'door');		
		$this->dropForeignKey('fk_door_from_room_id', 'door');		
		$this->dropForeignKey('fk_door_lock_type_id', 'door');		
		
		$this->dropForeignKey('fk_door_log_id', 'door_log');
		$this->dropForeignKey('fk_door_log_updated_by', 'door_log');
		$this->dropTable('door_log');
		
		$this->dropForeignKey('fk_door_created_by', 'door');
		$this->dropForeignKey('fk_door_updated_by', 'door');
		
        $this->dropTable('door');
    }
}
