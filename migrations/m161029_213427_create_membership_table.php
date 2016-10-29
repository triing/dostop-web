<?php

use yii\db\Migration;

class m161029_213427_create_membership_table extends Migration
{
    public function up()
    {
        $this->createTable('membership', [
            'id' => $this->primaryKey(),
			
			'person_id' => $this->integer()->notNull(),
			'organization_id' => $this->integer()->notNull(),
			'membership_type_id' => $this->integer()->notNull(),
			
			'valid_from' => $this->datetime()->notNull(),
			'valid_to' => $this->datetime(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_membership_person', 'membership', 'person_id', 'person', 'id');
		$this->addForeignKey('fk_membership_organization', 'membership', 'organization_id', 'organization', 'id');
		$this->addForeignKey('fk_membership_type', 'membership', 'membership_type_id', 'membership_type', 'id');
		
		$this->addForeignKey('fk_membership_created_by', 'membership', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_membership_updated_by', 'membership', 'updated_by', 'user', 'id');
		
        $this->createTable('membership_log', [
            'id' => $this->primaryKey(),
			'membership_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_membership_log_id', 'membership_log', 'membership_id', 'membership', 'id');
		$this->addForeignKey('fk_membership_log_updated_by', 'membership_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_membership_log_id', 'membership_log');
		$this->dropForeignKey('fk_membership_log_updated_by', 'membership_log');

		$this->dropTable('membership_log');
		
		$this->dropForeignKey('fk_membership_created_by', 'membership');
		$this->dropForeignKey('fk_membership_updated_by', 'membership');
		
		$this->dropForeignKey('fk_membership_person', 'membership');
		$this->dropForeignKey('fk_membership_organization', 'membership');
		$this->dropForeignKey('fk_membership_type', 'membership');

        $this->dropTable('membership');
    }
}
