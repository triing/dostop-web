<?php

use yii\db\Migration;

class m161029_151135_create_project_type_table extends Migration
{
    public function up()
    {
        $this->createTable('project_type', [
            'id' => $this->primaryKey(),
            'description_sl' => $this->string(32)->notNull(),
            'description_en' => $this->string(32)->notNull(),

			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		]);
		$this->addForeignKey('fk_project_type_created_by', 'project_type', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_project_type_updated_by', 'project_type', 'updated_by', 'user', 'id');
		
        $this->createTable('project_type_log', [
            'id' => $this->primaryKey(),
			'project_type_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_project_type_log_id', 'project_type_log', 'project_type_id', 'project_type', 'id');
		$this->addForeignKey('fk_project_type_log_updated_by', 'project_type_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_project_type_log_id', 'project_type_log');
		$this->dropForeignKey('fk_project_type_log_updated_by', 'project_type_log');
		$this->dropTable('project_type_log');
		
		$this->dropForeignKey('fk_project_type_created_by', 'project_type');
		$this->dropForeignKey('fk_project_type_updated_by', 'project_type');
		
        $this->dropTable('project_type');
    }
}
