<?php

use yii\db\Migration;

class m160724_162700_extend_organization_table extends Migration
{
    public function up()
    {
		 $this->addColumn('organization', 'organization_type_id', $this->integer());
		 $this->addColumn('organization', 'full_name', $this->string(64));
		 $this->addColumn('organization', 'email', $this->string(32));
		 $this->addColumn('organization', 'webpage', $this->string(32));
		 $this->addColumn('organization', 'phone', $this->string(16));
		 $this->addColumn('organization', 'country_code', $this->string(2)->notNull()->defaultValue('SI'));
		 $this->addColumn('organization', 'municipality_id', $this->integer());
		 $this->addColumn('organization', 'postal_code', $this->integer());
		 $this->addColumn('organization', 'street_id', $this->integer());
		 $this->addColumn('organization', 'house_no', $this->string(8));
		 $this->addColumn('organization', 'activity_type_id', $this->string(8));
		 $this->addColumn('organization', 'registration_number', $this->integer());
		 $this->addColumn('organization', 'tax_id', $this->integer());
		 $this->addColumn('organization', 'promoted', $this->boolean()->notNull()->defaultValue(true));
    }

    public function down()
    {
        $this->dropColumn('organization', 'organization_type_id');
        $this->dropColumn('organization', 'full_name');
        $this->dropColumn('organization', 'email');
        $this->dropColumn('organization', 'webpage');
        $this->dropColumn('organization', 'phone');
        $this->dropColumn('organization', 'country_code');
        $this->dropColumn('organization', 'municipality_id');
        $this->dropColumn('organization', 'postal_code');
        $this->dropColumn('organization', 'street_id');
        $this->dropColumn('organization', 'house_no');
        $this->dropColumn('organization', 'activity_type_id');
        $this->dropColumn('organization', 'registration_number');
        $this->dropColumn('organization', 'tax_id');
        $this->dropColumn('organization', 'promoted');

        return false;
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
