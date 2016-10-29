<?php

use yii\db\Migration;

class m160825_172843_create_floor_table extends Migration
{
    public function up()
    {
		$this->addColumn('building', 'code', $this->string(4));
		$this->addColumn('building', 'separator', $this->string(1));
		
        $this->createTable('floor', [
            'id' => $this->primaryKey(),
			'building_id' => $this->integer()->notNull(),
            'code' => $this->string(4)->notNull(),
            'name' => $this->string(32)->notNull(),
            'separator' => $this->string(1),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_floor_created_by', 'floor', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_floor_updated_by', 'floor', 'updated_by', 'user', 'id');
		
		$this->addForeignKey('fk_floor_building_id', 'floor', 'building_id', 'building', 'id');		
		
        $this->createTable('floor_log', [
            'id' => $this->primaryKey(),
			'floor_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_floor_log_id', 'floor_log', 'floor_id', 'floor', 'id');
		$this->addForeignKey('fk_floor_log_updated_by', 'floor_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropColumn('building', 'code');
		$this->dropColumn('building', 'separator');
		
		$this->dropForeignKey('fk_floor_building_id', 'floor');		
		
		$this->dropForeignKey('fk_floor_log_id', 'floor_log');
		$this->dropForeignKey('fk_floor_log_updated_by', 'floor_log');
		$this->dropTable('floor_log');
		
		$this->dropForeignKey('fk_floor_created_by', 'floor');
		$this->dropForeignKey('fk_floor_updated_by', 'floor');
        $this->dropTable('floor');
    }
}
