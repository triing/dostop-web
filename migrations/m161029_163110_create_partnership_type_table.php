<?php

use yii\db\Migration;

class m161029_163110_create_partnership_type_table extends Migration
{
    public function up()
    {
        $this->createTable('partnership_type', [
            'id' => $this->primaryKey(),
            'description_sl' => $this->string(32)->notNull(),
            'description_en' => $this->string(32)->notNull(),
			'allow_edit_project' => $this->boolean(),
			'allow_edit_partners' => $this->boolean(),
			'allow_edit_products' => $this->boolean(),
			'allow_edit_events' => $this->boolean(),
			'allow_edit_participants' => $this->boolean(),
			
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_partnership_type_created_by', 'partnership_type', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_partnership_type_updated_by', 'partnership_type', 'updated_by', 'user', 'id');
		
        $this->createTable('partnership_type_log', [
            'id' => $this->primaryKey(),
			'partnership_type_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_partnership_type_log_id', 'partnership_type_log', 'partnership_type_id', 'partnership_type', 'id');
		$this->addForeignKey('fk_partnership_type_log_updated_by', 'partnership_type_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_partnership_type_log_id', 'partnership_type_log');
		$this->dropForeignKey('fk_partnership_type_log_updated_by', 'partnership_type_log');
		$this->dropTable('partnership_type_log');
		
		$this->dropForeignKey('fk_partnership_type_created_by', 'partnership_type');
		$this->dropForeignKey('fk_partnership_type_updated_by', 'partnership_type');
		
        $this->dropTable('partnership_type');
    }
}
