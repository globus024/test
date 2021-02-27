<?php


namespace app\models;


use yii\helpers\ArrayHelper;

class PostSearch
{
    /**
     * @param array $from_user_list
     * @return Users[]|array
     *
     */
    public static function getPostListFromUser(array $from_user_list)
    {


        return ($users = Users::find()
            ->join('INNER JOIN','posts','posts.author_id=users.id')
            ->join('INNER JOIN','comments', 'comments.post_id=posts.id')
            ->where(['comments.from_user_id'=>$from_user_list])
            ->all());
    }

    public static function getTopComments($author_id,$from_user_id, $limit=10, $sort=SORT_DESC)
    {

        return ($comments = Comments::find()
            ->select('count(comments_ratings.comment_id) as from_user_id, comments.id, comments.post_id')
            ->join('INNER JOIN','posts','posts.id=comments.post_id')
            ->join('INNER JOIN','comments_ratings','comments_ratings.comment_id=comments.id')
            ->where([
                'comments.from_user_id'=>$from_user_id,
                'posts.author_id'=>$author_id
            ])
            ->groupBy(['comments.id'])
            ->orderBy(['count(comments_ratings.comment_id)'=>$sort])
            ->limit($limit)
            ->all());


    }


}