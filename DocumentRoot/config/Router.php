<?php
namespace App\config;

use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use Exception;

/**
 * Router calls the correct controller according requests.
 */
class Router
{
    private $frontController;
    private $backController;
    private $errorController;
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->frontController = new FrontController();
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
    }

    /**
     * Get route and call the correct controller.
     */
    public function run()
    {
        $route = $this->request->getGet()->get('route');
        try {
            if (isset($route)) {
                if ($route === 'article') {
                    $this->frontController->article($this->request->getGet()->get('articleId'));
                } elseif ($route === 'addArticle') {
                    $this->backController->addArticle($this->request->getPost());
                } elseif ($route === 'editArticle') {
                    $this->backController->editArticle(
                        $this->request->getPost(),
                        $this->request->getGet()->get('articleId')
                    );
                } elseif ($route === 'deleteArticle') {
                    $this->backController->deleteArticle(
                        $this->request->getGet()->get('articleId'),
                        $this->request->getGet()->get('token')
                    );
                } elseif ($route === 'addComment') {
                    $this->frontController->addComment(
                        $this->request->getPost(),
                        $this->request->getGet()->get('articleId')
                    );
                } elseif ($route === 'publishComment') {
                    $this->backController->publishComment(
                        $this->request->getGet()->get('commentId'),
                        $this->request->getGet()->get('token')
                    );
                } elseif ($route === 'flagComment') {
                    $this->frontController->flagComment(
                        $this->request->getGet()->get('commentId'),
                        $this->request->getGet()->get('token')
                    );
                } elseif ($route === 'unflagComment') {
                    $this->backController->unflagComment(
                        $this->request->getGet()->get('commentId'),
                        $this->request->getGet()->get('token')
                    );
                } elseif ($route === 'deleteComment') {
                    $this->backController->deleteComment(
                        $this->request->getGet()->get('commentId'),
                        $this->request->getGet()->get('token')
                    );
                } elseif ($route === 'register') {
                    $this->frontController->register($this->request->getPost());
                } elseif ($route === 'login') {
                    $this->frontController->login($this->request->getPost());
                } elseif ($route === 'profile') {
                    $this->backController->profile();
                } elseif ($route === 'updatePassword') {
                    $this->backController->updatePassword($this->request->getPost());
                } elseif ($route === 'logout') {
                    $this->backController->logout($this->request->getGet()->get('token'));
                } elseif ($route === 'deleteAccount') {
                    $this->backController->deleteAccount($this->request->getGet()->get('token'));
                } elseif ($route === 'deleteUser') {
                    $this->backController->deleteUser(
                        $this->request->getGet()->get('userId'),
                        $this->request->getGet()->get('token')
                    );
                } elseif ($route === 'admin_article') {
                    $this->backController->adminArticle();
                } elseif ($route === 'admin_comment') {
                    $this->backController->adminComment();
                } elseif ($route === 'admin_user') {
                    $this->backController->adminUser();
                } elseif ($route === 'contact') {
                    $this->frontController->contact($this->request->getPost());
                } else {
                    $this->errorController->errorNotFound();
                }
            } else {
                $this->frontController->home(
                    $this->request->getGet()->get('year'),
                    $this->request->getGet()->get('month')
                );
            }
        } catch (Exception $e) {
            $this->errorController->errorServer($e);
        }
    }
}
