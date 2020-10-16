<?php
/**
 * Comment Data Access Object.
 */
namespace App\src\DAO;

use App\src\model\Comment;

class CommentDAO extends DAO
{
    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setUserId($row['user_id']);
        $comment->setContent($row['content']);
        $comment->setCreatedDate($row['create_date']);
        return $comment;
    }

    public function getCommentsFromArticle($articleId)
    {
        $sql = 'SELECT id, content, user_id, create_date FROM comment WHERE article_id = ? ORDER BY create_date DESC';
        $result = $this->createQuery($sql, [$articleId]);
        $comments = [];
        foreach ($result as $row) {
            $comments[$row['id']] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }
}
