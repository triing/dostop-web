<?php

use yii\db\Migration;

class m161210_213844_extend_membership_type_table extends Migration
{
    public function up()
    {
		$this->addColumn('membership_type', 'access_rooms_always', $this->boolean()->notNull()->defaultValue(false));
		$this->addColumn('membership_type', 'access_rooms_working_hours', $this->boolean()->notNull()->defaultValue(false));

    }

    public function down()
    {
		$this->dropColumn('membership_type', 'access_rooms_always');
		$this->dropColumn('membership_type', 'access_rooms_working_hours');
    }

}
