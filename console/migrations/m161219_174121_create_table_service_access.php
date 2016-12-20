<?php

use yii\db\Migration;

class m161219_174121_create_table_service_access extends Migration
{
    public function up()
    {
        $this->createTable('{{%service_access}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),

            'id1' => $this->string(),
            'pw1' => $this->string(),

            'id2' => $this->string(),
            'pw2' => $this->string(),

            'id3' => $this->string(),
            'pw3' => $this->string(),


        ]);
    }

    public function down()
    {
        $this->dropTable('{{%service_access}}');
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
