<?php
class Comment extends Database
{
    public function getCommentsFromPost($postId)
    {
        $sql = 'SELECT id, content, user_id, create_date FROM comment WHERE post_id = ? ORDER BY create_date DESC';
        return $this->createQuery($sql, [$postId]);
    }
}
