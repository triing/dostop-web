<?php

use yii\db\Migration;

class m160723_113048_create_person_table extends Migration
{
    public function up()
    {
        $this->createTable('person', [
            'id' => $this->primaryKey(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'language' => $this->string(2)->notNull(),
			'first_name' => $this->string(32)->notNull(),
			'last_name' => $this->string(32)->notNull(),
			'user_id' => $this->integer(),
			'birth_date' => $this->date(),
			'sex' => $this->string(1),
			'status_id' => $this->integer(),
			'email' => $this->string(32),
			'phone' => $this->string(16),
			'municipality_id' => $this->integer(),
			'postal_code' => $this->integer(),
			'street_id' => $this->integer(),
			'house_no' => $this->string(8),
        ]);
		$this->addForeignKey('fk_person_created_by', 'person', 'created_by', 'user', 'id');
		$this->addForeignKey('fk_person_updated_by', 'person', 'updated_by', 'user', 'id');
		$this->addForeignKey('fk_person_user', 'person', 'user_id', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('fk_person_created_by','person');
		$this->dropForeignKey('fk_person_updated_by','person');
		$this->dropForeignKey('fk_person_user','person');
        $this->dropTable('person_table');
    }
}
