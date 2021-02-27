<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ratings}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%action_types}}`
 */
class m210227_095305_create_comments_ratings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments_ratings}}', [
            'id' => $this->primaryKey(),
            'comment_id' => $this->integer()->notNull(),
            'from_user_id' => $this->integer()->notNull(),
            'liked' => $this->boolean()->defaultValue(true),
            'created_at' => $this->dateTime()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `from_user_id`
        $this->createIndex(
            '{{%idx-comments_ratings-from_user_id}}',
            '{{%comments_ratings}}',
            'from_user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-comments_ratings-from_user_id}}',
            '{{%comments_ratings}}',
            'from_user_id',
            '{{%users}}',
            'id',
            'RESTRICT'
        );

        // creates index for column `action_types_id`
        $this->createIndex(
            '{{%idx-comments_ratings-comment_id}}',
            '{{%comments_ratings}}',
            'comment_id'
        );

        // add foreign key for table `{{%action_types}}`
        $this->addForeignKey(
            '{{%fk-comments_ratings-comment_id}}',
            '{{%comments_ratings}}',
            'comment_id',
            '{{%comments}}',
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
            '{{%fk-comments_ratings-from_user_id}}',
            '{{%comments_ratings}}'
        );

        // drops index for column `from_user_id`
        $this->dropIndex(
            '{{%idx-comments_ratings-from_user_id}}',
            '{{%comments_ratings}}'
        );

        // drops foreign key for table `{{%action_types}}`
        $this->dropForeignKey(
            '{{%fk-comments_ratings-comment_id}}',
            '{{%comments_ratings}}'
        );

        // drops index for column `action_types_id`
        $this->dropIndex(
            '{{%idx-comments_ratings-comment_id}}',
            '{{%comments_ratings}}'
        );

        $this->dropTable('{{%ratings}}');
    }
}
