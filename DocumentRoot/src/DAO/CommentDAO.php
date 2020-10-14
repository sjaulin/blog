<?php
/**
 * Comment Data Access Object.
 */
namespace App\src\DAO;

class CommentDAO extends DAO
{
    public function getCommentsFromPost($postId)
    {
        $sql = 'SELECT id, content, user_id, create_date FROM comment WHERE post_id = ? ORDER BY create_date DESC';
        return $this->createQuery($sql, [$postId]);
    }
}
