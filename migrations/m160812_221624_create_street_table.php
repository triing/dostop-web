<?php

use yii\db\Migration;

class m160812_221624_create_street_table extends Migration
{
    public function up()
    {
        $this->createTable('street', [
            'id' => $this->integer()->notNull()->unique(),
            'municipality_id' => $this->integer()->notNull(),
            'settlement_id' => $this->integer()->notNull(),
            'name' => $this->string(64)->notNull(),
            'country_code' => $this->string(2)->notNull()->defaultValue('SI'),
        ]);
		
		$this->addPrimaryKey('pk_street_id', 'street', 'id');
		$this->addForeignKey('fk_street_country_code', 'street', 'country_code', 'country', 'code');
		$this->addForeignKey('fk_street_municipality_id', 'street', 'municipality_id', 'municipality', 'id');
		$this->addForeignKey('fk_organization_street_id', 'organization', 'street_id', 'street', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_street_country_code', 'street');
		$this->dropForeignKey('fk_street_municipality_id', 'street');
		$this->dropForeignKey('fk_organization_street_id', 'organization');	
		$this->dropPrimaryKey('pk_street_id', 'street');
		
        $this->dropTable('street');
    }
}
