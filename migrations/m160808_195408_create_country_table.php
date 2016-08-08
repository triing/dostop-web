<?php

use yii\db\Migration;

class m160808_195408_create_country_table extends Migration
{
    public function up()
    {
        $this->createTable('country', [
            'code' => $this->string(2)->notNull()->unique(),
            'name' => $this->string(64)->notNull()->unique()
        ]);

		$this->insert('country', array(
			'code'=>'SI',
			'name' =>'SLOVENIA',
		));
		
		$this->addPrimaryKey('pk_country_code', 'country', 'code');
		$this->addForeignKey('fk_organization_country_code', 'organization', 'country_code', 'country', 'code');
    }

    public function down()
    {
		$this->dropForeignKey('fk_organization_country_code', 'organization');
		$this->addPrimaryKey('pk_country_code', 'country');
		
        $this->dropTable('country');
    }
}
