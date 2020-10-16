<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

class FrontController
{

    private $articleDAO;
    private $commentDAO;
    private $view;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
    }

    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        return $this->view->render(
            'home',
            [
                'articles' => $articles,
            ],
        );
    }

    /**
     * Put article to view.
     *
     * @param int $articleId The article Id.
     * @return void
     */
    public function article($articleId)
    {
        $article = $this->articleDAO->getarticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        //TODO Ajouter le titre de la page envoyé au template base ?
        return $this->view->render(
            'single',
            [
                'article' => $article,
                'comments' => $comments,
            ],
        );
    }
}
