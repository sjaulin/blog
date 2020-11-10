<?php
// TODO Découper en UserController, ArticleController, CommentController ?
namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
    public static $menu = array(
        'admin_article' => array('title' => 'Administrer les articles'),
        'admin_comment' => array('title' => 'Administrer les commentaires'),
        'admin_user' => array('title' => 'Administrer les utilisateurs')
    );

    // TODO move to router ?
    private function checkLoggedIn()
    {
        if (!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: index.php?route=login');
        } else {
            return true;
        }
    }

    // TODO move to router ?
    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if (!($this->session->get('role') === 'admin')) {
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: index.php?route=profile');
        } else {
            return true;
        }
    }

    public function adminArticle()
    {
        if ($this->checkAdmin()) {
            $articles = $this->articleDAO->getArticles(null, null, 1);
            return $this->view->renderAdmin('admin_article', [
                'menu' => self::$menu,
                'articles' => $articles,
            ]);
        }
    }

    public function adminComment()
    {
        if ($this->checkAdmin()) {
            $unpubliedcomments = $this->commentDAO->getUnpublishedComments();
            $flagcomments = $this->commentDAO->getFlagComments();
            return $this->view->renderAdmin('admin_comment', [
                'menu' => self::$menu,
                'unpubliedcomments' => $unpubliedcomments,
                'flagcomments' => $flagcomments,
            ]);
        }
    }

    public function adminUser()
    {
        if ($this->checkAdmin()) {
            $users = $this->userDAO->getUsers();
            return $this->view->renderAdmin('admin_user', [
                'menu' => self::$menu,
                'users' => $users,
            ]);
        }
    }
    
    public function addArticle(Parameter $post)
    {
        if ($this->checkAdmin()) {
            // The form is submitted.
            if ($post->get('submit')) {
                // Without error.
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
                    $this->articleDAO->addArticle($post, $this->session->get('id'));
                    $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                    header('Location: index.php?route=admin_article');
                }
                // With some errors.
                return $this->view->renderAdmin('add_article', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }

            // the form is displayed.
            return $this->view->renderAdmin('add_article');
        }
    }

    public function editArticle(Parameter $post, $articleId)
    {
        if ($this->checkAdmin()) {
            $article = $this->articleDAO->getArticle($articleId);
            // The form is submitted.
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                // Without error.
                if (!$errors) {
                    $this->articleDAO->editArticle($post, $articleId, $this->session->get('id'));
                    $this->session->set('edit_article', 'L\' article a bien été modifié');
                    header('Location: index.php?route=admin_article');
                }
                // With some errors.
                return $this->view->renderAdmin('edit_article', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }

            // the form is displayed, set default form values.
            $post->set('id', $article->getId());
            $post->set('title', $article->getTitle());
            $post->set('teaser', $article->getTeaser());
            $post->set('content', $article->getContent());
            $post->set('author', $article->getAuthor());
            $post->set('top', $article->getTop());

            return $this->view->renderAdmin('edit_article', [
                'menu' => self::$menu,
                'post' => $post
            ]);
        }
    }

    public function deleteArticle($articleId)
    {
        if ($this->checkAdmin()) {
            $this->articleDAO->deleteArticle($articleId);
            $this->session->set('delete_article', 'L\' article a bien été supprimé');
            header('Location: index.php?route=admin_article');
        }
    }

    public function publishComment($commentId)
    {
        $this->commentDAO->publishComment($commentId);
        $this->session->set('alert_comment', 'Le commentaire a bien été publié');
        header('Location: index.php?route=admin_comment');
    }

    public function unflagComment($commentId)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('alert_comment', 'Le commentaire a bien été désignalé');
            header('Location: index.php?route=admin_comment');
        }
    }

    public function deleteComment($commentId)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('alert_comment', 'Le commentaire a bien été supprimé');
            header('Location: index.php?route=admin_comment');
        }
    }

    public function profile()
    {
        if ($this->checkLoggedIn()) {
            return $this->view->render('profile');
        }
    }

    public function updatePassword(Parameter $post)
    {
        if ($this->checkLoggedIn()) {
            if ($post->get('submit')) {
                $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
                $this->session->set('update_password', 'Le mot de passe a été mis à jour');
                header('Location: index.php?route=profile');
            }
            return $this->view->render('update_password');
        }
    }

    public function logout()
    {
        if ($this->checkLoggedIn()) {
            $this->session->stop();
            $this->session->start();
            $this->session->set('logout', 'À bientôt');
            header('Location: index.php');
        }
    }

    public function deleteAccount()
    {
        if ($this->checkLoggedIn()) {
            $this->userDAO->deleteAccount($this->session->get('pseudo'));
            $this->session->stop();
            $this->session->start();
            $this->session->set('delete_account', 'Votre compte a bien été supprimé');
            header('Location: index.php');
        }
    }

    public function deleteUser($userId)
    {
        if ($this->checkAdmin()) {
            $this->userDAO->deleteUser($userId);
            $this->session->set('delete_user', 'L\'utilisateur a bien été supprimé');
            header('Location: index.php?route=admin_user');
        }
    }
}
