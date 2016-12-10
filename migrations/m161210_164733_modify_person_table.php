<?php

use yii\db\Migration;

class m161210_164733_modify_person_table extends Migration
{
    public function up()
    {
		$this->dropForeignKey('fk_person_user','person');
        $this->dropColumn('person', 'user_id');
//		$this->addForeignKey('fk_person_user', 'person', 'email', 'user', 'email');
		$this->addColumn('person', 'exact_birth_date', $this->boolean()->notNull()->defaultValue(false));

    }

    public function down()
    {
		$this->dropColumn('person', 'exact_birth_date');
//		$this->dropForeignKey('fk_person_user', 'person');
		$this->addColumn('person', 'user_id', $this->integer());
		$this->addForeignKey('fk_person_user', 'person', 'user_id', 'user', 'id');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
