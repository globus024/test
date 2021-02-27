<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%action_types}}`
 */
class m210227_094415_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'from_user_id' => $this->integer()->notNull(),
            'body' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `from_user_id`
        $this->createIndex(
            '{{%idx-comments-from_user_id}}',
            '{{%comments}}',
            'from_user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-comments-from_user_id}}',
            '{{%comments}}',
            'from_user_id',
            '{{%users}}',
            'id',
            'RESTRICT'
        );

        // creates index for column `action_types_id`
        $this->createIndex(
            '{{%idx-comments-post_id}}',
            '{{%comments}}',
            'id'
        );

        // add foreign key for table `{{%action_types}}`
        $this->addForeignKey(
            '{{%fk-comments-post_id}}',
            '{{%comments}}',
            'post_id',
            '{{%posts}}',
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
            '{{%fk-comments-from_user_id}}',
            '{{%comments}}'
        );

        // drops index for column `from_user_id`
        $this->dropIndex(
            '{{%idx-comments-from_user_id}}',
            '{{%comments}}'
        );

        // drops foreign key for table `{{%action_types}}`
        $this->dropForeignKey(
            '{{%fk-comments-post_id}}',
            '{{%comments}}'
        );

        // drops index for column `action_types_id`
        $this->dropIndex(
            '{{%idx-comments-post_id}}',
            '{{%comments}}'
        );

        $this->dropTable('{{%comments}}');
    }
}
