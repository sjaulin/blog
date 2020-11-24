<?php
/**
 * Comment Data Access Object.
 */
namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Comment;

class CommentDAO extends DAO
{
    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setArticleId($row['article_id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setCreatedDate($row['create_date']);
        $comment->setFlag($row['flag']);
        return $comment;
    }

    public function getCommentsFromArticle($articleId)
    {
        $sql = 'SELECT comment.id, comment.content, user.pseudo, comment.create_date, comment.article_id, comment.flag FROM comment 
        INNER JOIN user ON user.id = comment.user_id WHERE article_id = ? AND published = 1 ORDER BY create_date DESC';
        $result = $this->createQuery($sql, [$articleId]);
        $comments = [];
        foreach ($result as $row) {
            $comments[$row['id']] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function addComment(Parameter $post, $articleId, $userId)
    {
        $sql = 'INSERT INTO comment (user_id, content, create_date, article_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [$userId, $post->get('content'), $articleId]);
    }

    public function publishComment($commentId)
    {
        $sql = 'UPDATE comment SET published = ? WHERE id = ?';
        $this->createQuery($sql, [1, $commentId]);
    }

    public function flagComment($commentId)
    {
        $sql = 'UPDATE comment SET flag = ? WHERE id = ?';
        $this->createQuery($sql, [1, $commentId]);
    }
    
    public function unflagComment($commentId)
    {
        $sql = 'UPDATE comment SET flag = ? WHERE id = ?';
        $this->createQuery($sql, [0, $commentId]);
    }
    
    public function deleteComment($commentId)
    {
        $sql = 'DELETE FROM comment WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }

    public function getUnpublishedComments()
    {
        $sql = 'SELECT comment.id, user.pseudo, comment.content, comment.create_date, comment.article_id, comment.flag 
        FROM comment INNER JOIN user ON user.id = comment.user_id WHERE (published IS NULL OR published = 0) 
        ORDER BY create_date DESC';
        $result = $this->createQuery($sql);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function getFlagComments()
    {
        $sql = 'SELECT comment.id, user.pseudo, comment.content, comment.create_date, comment.article_id 
        FROM comment INNER JOIN user ON user.id = comment.user_id WHERE flag = ? 
        ORDER BY create_date DESC';
        $result = $this->createQuery($sql, [1]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }
}
