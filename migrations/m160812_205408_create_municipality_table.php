<?php

use yii\db\Migration;

class m160812_205408_create_municipality_table extends Migration
{
    public function up()
    {
        $this->createTable('municipality', [
            'id' => $this->integer()->notNull()->unique(),
            'name' => $this->string(64)->notNull(),
            'type' => $this->string(1)->notNull(),
            'country_code' => $this->string(2)->notNull()->defaultValue('SI'),
        ]);
		
		$this->addPrimaryKey('pk_municipality_id', 'municipality', 'id');
		$this->addForeignKey('fk_municipality_country_code', 'municipality', 'country_code', 'country', 'code');
		$this->addForeignKey('fk_organization_municipality_id', 'organization', 'municipality_id', 'municipality', 'id');
    }

    public function down()
    {

		$this->dropForeignKey('fk_municipality_country_code', 'municipality');
		$this->dropForeignKey('fk_organization_municipality_id', 'organization');
		$this->dropPrimaryKey('pk_municipality_id', 'municipality');
	
		$this->dropTable('municipality');
    }
}
