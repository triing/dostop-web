<?php

use yii\db\Migration;

class m160216_223656_create_organization_table extends Migration
{
    public function up()
    {
        $this->createTable('organization', [
            'id' => $this->primaryKey(),
			'slug' => $this->string(16)->notNull()->unique(),
			'created_by' => $this->integer(),
			'updated_by' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
			'name' => $this->string(64)->notNull()->unique(),
			'domain' => $this->string(32)->notNull()->unique(),
			'description' => $this->text(),
			'language' => $this->string(2)->notNull(),
		]);
		$this->addForeignKey('fk_organization_created_by', 'organization', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_organization_updated_by', 'organization', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_organization_created_by','organization');
		$this->dropForeignKey('fk_organization_updated_by','organization');
        $this->dropTable('organization');
    }
}
