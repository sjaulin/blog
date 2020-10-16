<?php

/**
 * Article Data Access Object.
 */

namespace App\src\DAO;

use App\src\model\Article;

class ArticleDAO extends DAO
{
    // Convert database cols to object properties.
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setUserId($row['user_id']);
        $article->setCreatedDate($row['create_date']);
        $article->setUpdatedDate($row['update_date']);
        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT id, title, content, user_id, create_date, update_date FROM article ORDER BY id DESC';
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
        $sql = 'SELECT id, title, content, user_id, create_date, update_date FROM article WHERE id = ?';
        $result = $this->createQuery($sql, [$articleId]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }
}
