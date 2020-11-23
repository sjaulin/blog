<?php

/**
 * Article Data Access Object.
 */

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Article;

class ArticleDAO extends DAO
{
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setTeaser($row['teaser']);
        $article->setContent($row['content']);
        $article->setAuthor($row['pseudo']);
        $article->setCreatedDate($row['create_date']);
        $article->setUpdatedDate($row['update_date']);
        $article->setTop($row['top']);
        return $article;
    }

    public function getArticles($year = null, $month = null, $all = null)
    {
        $sql = 'SELECT article.id, article.title, article.teaser, article.content, user.pseudo, date_format(article.create_date, "%d %M %Y à %H:%i:%s") create_date, article.update_date, article.top FROM article ' .
            'INNER JOIN user ON article.user_id = user.id ';

        if (!empty($year) && !empty($month)) {
            $sql .= 'WHERE date_format(article.create_date, "%Y") = "' . $year . '" AND date_format(article.create_date, "%m") = "' . $month . '" ';
        } elseif (empty($all)) {
            $sql .= 'WHERE article.top = 1 ';
        }

        $sql .= 'ORDER BY article.id DESC';
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
        $sql = 'SELECT article.id, article.title, article.teaser, article.content, date_format(article.create_date, "%d %M %Y à %H:%i:%s") create_date, date_format(article.update_date, "%d %M %Y à %H:%i:%s") update_date, article.top, ' .
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
        $sql = 'INSERT INTO article (title, teaser, content, create_date, update_date, user_id) ' .
            ' VALUES (?, ?, ?, NOW(), NOW(), ?)';
        $this->createQuery($sql, [$post->get('title'), $post->get('teaser'), $post->get('content'), $userId]);
    }

    public function editArticle(Parameter $post, $articleId, $userId)
    {
        $sql = 'UPDATE article SET title=:title, teaser=:teaser, content=:content, top=:top, update_date = NOW() WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'teaser' => $post->get('teaser'),
            'content' => $post->get('content'),
            'top' => !empty($post->get('top')) ? 1 : 0,
            'articleId' => $articleId
        ]);
    }

    public function deleteArticle($articleId)
    {
        // no comment deletion here because there is a mysql trigger.
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }

    public function getArticlesMenu()
    {
        $sql = 'select 
        date_format(create_date, "%M %Y") as title, 
        date_format(create_date, "%m") as month, 
        date_format(create_date, "%Y") as year, 
        count(id) as nb from article
        GROUP BY MONTH(create_date), YEAR(create_date) 
        ORDER by YEAR(create_date) DESC, MONTH(create_date) DESC';
        $result = $this->createQuery($sql);
        $menu = $result->fetchAll();
        $result->closeCursor();
        return $menu;
    }
}
