<?php

use yii\db\Migration;

class m160809_150657_create_post_table extends Migration
{
    public function up()
    {
        $this->createTable('post', [
            'code' => $this->integer()->notNull()->unique(),
            'name' => $this->string(64)->notNull(),
            'country_code' => $this->string(2)->notNull()->defaultValue('SI'),
        ]);
		
		$this->addPrimaryKey('pk_postal_code', 'post', 'code');
		$this->addForeignKey('fk_post_country_code', 'post', 'country_code', 'country', 'code');
		$this->addForeignKey('fk_organization_post_code', 'organization', 'postal_code', 'post', 'code');
    }

    public function down()
    {
		$this->dropForeignKey('fk_post_country_code', 'post');
		$this->dropForeignKey('fk_organization_post_code', 'organization');
		$this->dropPrimaryKey('pk_postal_code', 'post');
		
        $this->dropTable('post');
    }
}
