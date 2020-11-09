<?php

namespace App\src\model;

use App\config\Request;

class View
{
    private $file;
    private $title;
    private $request;
    private $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->session = $this->request->getSession();
    }

    public function render($template, $data = [])
    {
        // template menu
        $this->menufile = '../templates/menu_front.php';
        $menucontent = $this->renderFile($this->menufile, $data);

        // template page
        $this->file = '../templates/'.$template.'.php';
        $content  = $this->renderFile($this->file, $data);

        $view = $this->renderFile('../templates/base.php', [
            'title' => $this->title,
            'menucontent' => $menucontent,
            'content' => $content,
            'session' => $this->session,
        ]);
        echo $view;
    }

    public function renderAdmin($template, $data = [])
    {
        // template menu
        $this->menufile = '../templates/menu_back.php';
        $menucontent = $this->renderFile($this->menufile, $data);

        // template page
        $this->file = '../templates/'.$template.'.php';
        $content  = $this->renderFile($this->file, $data);

        $view = $this->renderFile('../templates/base.php', [
            'title' => $this->title,
            'menucontent' => $menucontent,
            'content' => $content,
            'session' => $this->session,
        ]);
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        header('Location: index.php?route=notFound');
    }
}
