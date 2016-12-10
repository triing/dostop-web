<?php

use yii\db\Migration;

class m161210_224229_create_management_type_table extends Migration
{
    public function up()
    {
        $this->createTable('management_type', [
            'id' => $this->primaryKey(),
            'description_sl' => $this->string(32)->notNull(),
            'description_en' => $this->string(32)->notNull(),
			'access_always' => $this->boolean()->notNull()->defaultValue(true),
			'access_working_hours' => $this->boolean()->notNull()->defaultValue(true),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_management_type_created_by', 'management_type', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_management_type_updated_by', 'management_type', 'updated_by', 'user', 'id');
		
        $this->createTable('management_type_log', [
            'id' => $this->primaryKey(),
			'management_type_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_management_type_log_id', 'management_type_log', 'management_type_id', 'management_type', 'id');
		$this->addForeignKey('fk_management_type_log_updated_by', 'management_type_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_management_type_created_by', 'management_type');
		$this->dropForeignKey('fk_management_type_updated_by', 'management_type');
        $this->dropTable('management_type');
		$this->dropForeignKey('fk_management_type_log_id', 'management_type_log');
		$this->dropForeignKey('fk_management_type_log_updated_by', 'management_type_log');
		$this->dropTable('management_type_log');
    }
}
