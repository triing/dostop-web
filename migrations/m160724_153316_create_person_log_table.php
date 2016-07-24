<?php

use yii\db\Migration;

class m160724_153316_create_person_log_table extends Migration
{
    public function up()
    {
        $this->createTable('person_log', [
            'id' => $this->primaryKey(),
			'person_id' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey('fk_person_id', 'person_log', 'person_id', 'person', 'id');
		$this->addForeignKey('fk_person_log_updated_by', 'person_log', 'updated_by', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_person_id','person_log');
		$this->dropForeignKey('fk_person_log_updated_by','person_log');
		
        $this->dropTable('person_log');
    }
}
