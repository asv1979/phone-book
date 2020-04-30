<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200428_153906_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'f_name' => $this->string(30)->notNull(),
            'l_name' => $this->string(50)->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('{{%idx-user_user-name}}', '{{%users}}', ['f_name', 'l_name'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%users}}');
    }
}
