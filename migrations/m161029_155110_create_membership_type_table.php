<?php

use yii\db\Migration;

class m161029_155110_create_membership_type_table extends Migration
{
    public function up()
    {
        $this->createTable('membership_type', [
            'id' => $this->primaryKey(),
            'description_sl' => $this->string(32)->notNull(),
            'description_en' => $this->string(32)->notNull(),
			'allow_edit_organization' => $this->boolean(),
			'allow_edit_projects' => $this->boolean(),
			'allow_edit_members' => $this->boolean(),
			'allow_edit_projects' => $this->boolean(),
			'allow_edit_rooms' => $this->boolean(),
			'allow_edit_resources' => $this->boolean(),
			'allow_edit_products' => $this->boolean(),
			'allow_edit_events' => $this->boolean(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_membership_type_created_by', 'membership_type', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_membership_type_updated_by', 'membership_type', 'updated_by', 'user', 'id');
		
        $this->createTable('membership_type_log', [
            'id' => $this->primaryKey(),
			'membership_type_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_membership_type_log_id', 'membership_type_log', 'membership_type_id', 'membership_type', 'id');
		$this->addForeignKey('fk_membership_type_log_updated_by', 'membership_type_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_membership_type_log_id', 'membership_type_log');
		$this->dropForeignKey('fk_membership_type_log_updated_by', 'membership_type_log');
		$this->dropTable('membership_type_log');
		
		$this->dropForeignKey('fk_membership_type_created_by', 'membership_type');
		$this->dropForeignKey('fk_membership_type_updated_by', 'membership_type');
		
        $this->dropTable('membership_type');
    }
}
