<?php

use yii\db\Migration;

class m160825_161402_create_building_table extends Migration
{
    public function up()
    {
        $this->createTable('building', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_building_created_by', 'building', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_building_updated_by', 'building', 'updated_by', 'user', 'id');
		
        $this->createTable('building_log', [
            'id' => $this->primaryKey(),
			'building_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_building_log_id', 'building_log', 'building_id', 'building', 'id');
		$this->addForeignKey('fk_building_log_updated_by', 'building_log', 'updated_by', 'user', 'id');
		
    }

    public function down()
    {
		$this->dropForeignKey('fk_building_log_id', 'building_log');
		$this->dropForeignKey('fk_building_log_updated_by', 'building_log');
		$this->dropTable('building_log');
		
		$this->dropForeignKey('fk_building_created_by', 'building');
		$this->dropForeignKey('fk_building_updated_by', 'building');
        $this->dropTable('building');
    }
}
