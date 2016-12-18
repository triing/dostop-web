<?php

use yii\db\Migration;

class m161213_190952_create_working_time_table extends Migration
{
    public function up()
    {
        $this->createTable('working_time', [
            'id' => $this->primaryKey(),
			'room_management_id' => $this->integer(),
			'building_management_id' => $this->integer(),
			'start_time' => $this->datetime()->notNull(),
			'end_time' => $this->datetime()->notNull(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_working_time_created_by', 'working_time', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_working_time_updated_by', 'working_time', 'updated_by', 'user', 'id');

		$this->addForeignKey('fk_working_time_room_management', 'working_time', 'room_management_id', 'room_management', 'id');
//		$this->addForeignKey('fk_working_time_building_management', 'working_time', 'building_management_id', 'building_management', 'id');

        $this->createTable('working_time_log', [
            'id' => $this->primaryKey(),
			'working_time_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_working_time_log_id', 'working_time_log', 'working_time_id', 'working_time', 'id');
		$this->addForeignKey('fk_working_time_log_updated_by', 'working_time_log', 'updated_by', 'user', 'id');

	}

    public function down()
    {
		$this->dropForeignKey('fk_working_time_room_management', 'working_time');
//		$this->dropForeignKey('fk_working_time_building_management', 'working_time');
		$this->dropForeignKey('fk_working_time_created_by', 'working_time');
		$this->dropForeignKey('fk_working_time_updated_by', 'working_time');
        $this->dropTable('working_time');
		
		$this->dropForeignKey('fk_working_time_log_id', 'working_time_log');
		$this->dropForeignKey('fk_working_time_log_updated_by', 'working_time_log');
        $this->dropTable('working_time_log');
    }
}
