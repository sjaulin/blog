<?php

namespace App\src\controller;

use App\config\Request;
use App\src\constraint\Validation;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\model\Mailer;
use App\src\model\View;

abstract class Controller
{
    protected $articleDAO;
    protected $commentDAO;
    protected $userDAO;
    protected $view;
    protected $mailer;
    private $request;
    protected $get;
    protected $post;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->mailer = new Mailer();
        $this->validation = new Validation();
        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
    }

    protected function checkLoggedIn()
    {
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $site = parse_url($_SERVER['HTTP_REFERER']);
            $host = !empty($site['host']) ? $site['host'] : null;
        }

        if (!$this->session->get('pseudo') && !empty($_SERVER['SERVER_NAME']) && !empty($host) && $_SERVER['SERVER_NAME'] == $host) {
            $this->session->set('alert', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: index.php?route=login');
        } else {
            return true;
        }
    }
    
    protected function checkToken($token)
    {
        if (!empty($token) && !empty($this->session->get('token'))) {
            if ($token == $this->session->get('token')) {
                return true;
            }
        }

        return false;
    }
}
