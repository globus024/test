<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 */
class m210227_093123_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'publication_date' => $this->dateTime(),
            'title' => $this->string(2048)->notNull(),
            'publication_text' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-posts-author_id}}',
            '{{%posts}}',
            'author_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-posts-author_id}}',
            '{{%posts}}',
            'author_id',
            '{{%users}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-posts-author_id}}',
            '{{%posts}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-posts-author_id}}',
            '{{%posts}}'
        );

        $this->dropTable('{{%posts}}');
    }
}
