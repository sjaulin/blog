<?php

/**
 * Article Data Access Object.
 */

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Article;

class ArticleDAO extends DAO
{
    // Convert database cols to object properties. (hydratation)
    //TODO : https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1666289-manipulation-de-donnees-stockees#/id/r-1669539
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['pseudo']);
        $article->setCreatedDate($row['create_date']);
        $article->setUpdatedDate($row['update_date']);
        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo, article.create_date, article.update_date FROM article ' .
            'INNER JOIN user ON article.user_id = user.id ORDER BY article.id DESC';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row) {
            $articles[$row['id']] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    /**
     * Get article oject by article ID
     *
     * @param int $articleId
     * @return object The Article Object.
     */
    public function getArticle($articleId)
    {
        $sql = 'SELECT article.id, article.title, article.content, article.create_date, article.update_date, ' .
            'user.pseudo ' .
            'FROM article INNER JOIN user ON article.user_id = user.id WHERE article.id = ?';
        $result = $this->createQuery($sql, [$articleId]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }

    public function addArticle($post, $userId)
    {
        //Permet de récupérer les variables $title, $content et $author
        $sql = 'INSERT INTO article (title, content, create_date, user_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $userId]);
    }

    public function editArticle(Parameter $post, $articleId, $userId)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, user_id=:user_id WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'user_id' => $userId, // TODO Do not update user_id.
            'articleId' => $articleId
        ]);
    }

    public function deleteArticle($articleId)
    {
        // no comment deletion here because there is a mysql trigger.
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }
}
