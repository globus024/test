<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $author_id
 * @property string|null $publication_date
 * @property string $title
 * @property string $publication_text
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Users $author
 * @property Comments[] $comments
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'title', 'publication_text'], 'required'],
            [['author_id'], 'integer'],
            [['publication_date', 'created_at', 'updated_at'], 'safe'],
            [['publication_text'], 'string'],
            [['title'], 'string', 'max' => 2048],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'publication_date' => Yii::t('app', 'Publication Date'),
            'title' => Yii::t('app', 'Title'),
            'publication_text' => Yii::t('app', 'Publication Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Users::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id']);
    }
}
