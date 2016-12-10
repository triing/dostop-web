<?php

use yii\db\Migration;

class m161210_230639_create_room_management_table extends Migration
{
    public function up()
    {
        $this->createTable('room_management', [
            'id' => $this->primaryKey(),
			'organization_id' => $this->integer()->notNull(),
			'room_id' => $this->integer()->notNull(),
			'management_type_id' => $this->integer()->notNull(),
			'contract_id' => $this->integer(),
			'start_date' => $this->datetime()->notNull(),
			'end_date' => $this->datetime(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_room_management_created_by', 'room_management', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_room_management_updated_by', 'room_management', 'updated_by', 'user', 'id');
		
		$this->addForeignKey('fk_room_management_organization', 'room_management', 'organization_id', 'organization', 'id');
		$this->addForeignKey('fk_room_management_room', 'room_management', 'room_id', 'room', 'id');
		$this->addForeignKey('fk_room_management_type', 'room_management', 'management_type_id', 'management_type', 'id');

        $this->createTable('room_management_log', [
            'id' => $this->primaryKey(),
			'room_management_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_room_management_log_id', 'room_management_log', 'room_management_id', 'room_management', 'id');
		$this->addForeignKey('fk_room_management_log_updated_by', 'room_management_log', 'updated_by', 'user', 'id');
		
	}

    public function down()
    {
		$this->dropForeignKey('fk_room_management_log_id', 'room_management_log');
		$this->dropForeignKey('fk_room_management_log_updated_by', 'room_management_log');
        $this->dropTable('room_management_log');

		$this->dropForeignKey('fk_room_management_created_by', 'room_management');
		$this->dropForeignKey('fk_room_management_updated_by', 'room_management');
		$this->dropForeignKey('fk_room_management_organization', 'room_management');
		$this->dropForeignKey('fk_room_management_room', 'room_management');
		$this->dropForeignKey('fk_room_management_type', 'room_management');
        $this->dropTable('room_management');

	}
}
