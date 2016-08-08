<?php

use yii\db\Migration;

class m160808_152018_create_organization_log_table extends Migration
{
    public function up()
    {
        $this->createTable('organization_log', [
            'id' => $this->primaryKey(),
			'organization_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_organization_id', 'organization_log', 'organization_id', 'organization', 'id');
		$this->addForeignKey('fk_organization_log_updated_by', 'organization_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_organization_id','organization_log');
		$this->dropForeignKey('fk_organization_log_updated_by','organization_log');
		
        $this->dropTable('organization_log');
    }
}
