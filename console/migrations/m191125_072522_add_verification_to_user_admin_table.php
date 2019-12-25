<?php

use yii\db\Migration;

/**
 * Class m191125_072522_add_verification_to_user_admin_table
 */
class m191125_072522_add_verification_to_user_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191125_072522_add_verification_to_user_admin_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191125_072522_add_verification_to_user_admin_table cannot be reverted.\n";

        return false;
    }
    */
}
