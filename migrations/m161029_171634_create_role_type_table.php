<?php

use yii\db\Migration;

class m161029_171634_create_role_type_table extends Migration
{
    public function up()
    {
        $this->createTable('role_type', [
            'id' => $this->primaryKey(),
            'description_sl' => $this->string(32)->notNull(),
            'description_en' => $this->string(32)->notNull(),
			'allow_edit_project' => $this->boolean(),
			'allow_edit_partners' => $this->boolean(),
			'allow_edit_products' => $this->boolean(),
			'allow_edit_events' => $this->boolean(),
			'allow_edit_participants' => $this->boolean(),
			'allow_edit_roles' => $this->boolean(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_role_type_created_by', 'role_type', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_role_type_updated_by', 'role_type', 'updated_by', 'user', 'id');
		
        $this->createTable('role_type_log', [
            'id' => $this->primaryKey(),
			'role_type_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_role_type_log_id', 'role_type_log', 'role_type_id', 'role_type', 'id');
		$this->addForeignKey('fk_role_type_log_updated_by', 'role_type_log', 'updated_by', 'user', 'id');
		
		$this->addColumn('partnership_type', 'allow_edit_roles', $this->boolean());
		
    }

    public function down()
    {
		$this->dropColumn('partnership_type', 'allow_edit_roles');
	
		$this->dropForeignKey('fk_role_type_log_id', 'role_type_log');
		$this->dropForeignKey('fk_role_type_log_updated_by', 'role_type_log');
		$this->dropTable('role_type_log');
		
		$this->dropForeignKey('fk_role_type_created_by', 'role_type');
		$this->dropForeignKey('fk_role_type_updated_by', 'role_type');
		
        $this->dropTable('role_type');
    }
}
