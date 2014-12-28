<?php

use yii\db\Schema;
use wolfguard\config\migrations\Migration;

class m141228_120928_init extends Migration
{
    public function up()
    {
        $this->createTable('{{%config}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' DEFAULT NULL',
            'code' =>  Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_TEXT . ' DEFAULT NULL',
            'system' => Schema::TYPE_BOOLEAN . ' DEFAULT \'1\'',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createIndex('ix_config_code', '{{%config}}', 'code', true);
        $this->createIndex('ix_config_system', '{{%config}}', 'system', false);
        $this->createIndex('ix_config_name', '{{%config}}', 'name', false);
    }

    public function down()
    {
        $this->dropTable('{{%config}}');
    }
}
