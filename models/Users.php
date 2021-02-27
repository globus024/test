<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $name
 * @property string $login
 * @property string $email
 * @property string $password_hash
 * @property string|null $last_entry
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Comments[] $comments
 * @property CommentsRatings[] $commentsRatings
 * @property Posts[] $posts
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'email', 'password_hash'], 'required'],
            [['last_entry', 'created_at', 'updated_at'], 'safe'],
            [['name', 'login', 'email', 'password_hash'], 'string', 'max' => 255],
            [['login'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'login' => Yii::t('app', 'Login'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'last_entry' => Yii::t('app', 'Last Entry'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['from_user_id' => 'id']);
    }

    /**
     * Gets query for [[CommentsRatings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentsRatings()
    {
        return $this->hasMany(CommentsRatings::className(), ['from_user_id' => 'id']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['author_id' => 'id']);
    }
}
