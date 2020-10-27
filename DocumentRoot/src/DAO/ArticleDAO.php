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
        $article->setAuthor($row['author']);
        $article->setCreatedDate($row['create_date']);
        $article->setUpdatedDate($row['update_date']);
        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT id, title, content, author, create_date, update_date FROM article ORDER BY id DESC';
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
        $sql = 'SELECT id, title, content, author, create_date, update_date FROM article WHERE id = ?';
        $result = $this->createQuery($sql, [$articleId]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }

    public function addArticle($post)
    {
        //Permet de récupérer les variables $title, $content et $author
        $sql = 'INSERT INTO article (title, content, author, create_date) VALUES (?, ?, ?, NOW())';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $post->get('author')]);
    }

    public function editArticle(Parameter $post, $articleId)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, author=:author WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'author' => $post->get('author'),
            'articleId' => $articleId
        ]);
    }
}
