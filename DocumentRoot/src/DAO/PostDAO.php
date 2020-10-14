<?php
/**
 * Post Data Access Object.
 */
namespace App\src\DAO;

class PostDAO extends DAO
{
    public function getPosts()
    {
        $sql = 'SELECT id, title, content, user_id, create_date FROM post ORDER BY id DESC';
        return $this->createQuery($sql);
    }

    public function getPost($postId)
    {
        $sql = 'SELECT id, title, content, user_id, create_date FROM post WHERE id = ?';
        return $this->createQuery($sql, [$postId]);
    }
}
