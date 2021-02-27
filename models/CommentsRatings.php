<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments_ratings".
 *
 * @property int $id
 * @property int $comment_id
 * @property int $from_user_id
 * @property int|null $liked
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Comments $comment
 * @property Users $fromUser
 */
class CommentsRatings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments_ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_id', 'from_user_id'], 'required'],
            [['comment_id', 'from_user_id', 'liked'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::className(), 'targetAttribute' => ['comment_id' => 'id']],
            [['from_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['from_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'comment_id' => Yii::t('app', 'Comment ID'),
            'from_user_id' => Yii::t('app', 'From User ID'),
            'liked' => Yii::t('app', 'Liked'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comments::className(), ['id' => 'comment_id']);
    }

    /**
     * Gets query for [[FromUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'from_user_id']);
    }
}
