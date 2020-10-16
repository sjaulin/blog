<?php

namespace App\src\controller;

use App\src\DAO\PostDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

class FrontController
{

    private $postDAO;
    private $commentDAO;
    private $view;

    public function __construct()
    {
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
    }

    public function home()
    {
        $posts = $this->postDAO->getPosts();
        return $this->view->render(
            'home',
            [
                'posts' => $posts,
            ],
        );
    }

    /**
     * Put post to view.
     *
     * @param int $postId The post Id.
     * @return void
     */
    public function post($postId)
    {
        $post = $this->postDAO->getPost($postId);
        $comments = $this->commentDAO->getCommentsFromPost($postId);
        //TODO Ajouter le titre de la page envoyé au template base ?
        return $this->view->render(
            'single',
            [
                'post' => $post,
                'comments' => $comments,
            ],
        );
    }
}
