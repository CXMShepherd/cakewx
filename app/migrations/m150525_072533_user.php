<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_072533_user extends Migration
{
    public function up()
    {
        $this->createTable('i_users', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'created' => Schema::TYPE_INT,
            'created' => Schema::TYPE_INT
        ]);
    }

    public function down()
    {
        $this->dropTable('i_users');
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
