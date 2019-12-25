<?php

use yii2mod\rbac\migrations\Migration;
/**
 * Class m191121_202722_create_role_admin
 */
class m191121_202722_create_role_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createRole('admin', 'admin has all available permissions.');
        $this->createRole('author', 'admin has all available permissions.');
        $this->createRole('user', 'admin has all available permissions.');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191121_202722_create_role_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191121_202722_create_role_admin cannot be reverted.\n";

        return false;
    }
    */
}
