<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_phones}}`.
 */
class m200428_175443_create_user_phones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%user_phones}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'phone' => $this->string(18)->notNull()->unique(),

        ]);
        $this->createIndex('{{%idx-user_phones-user-phone}}', '{{%user_phones}}', [ 'phone'], true);

        $this->createIndex('{{%idx-user_phones-user_id}}', '{{%user_phones}}', 'user_id');

        $this->addForeignKey('{{%fk-user_phones-user_id}}', '{{%user_phones}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%user_phones}}');
    }
}
