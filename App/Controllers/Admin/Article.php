<?php

namespace App\Controllers\Admin;

use App\Classes\BaseController;
use App\Classes\Logger;
use App\Exceptions\NotFound404;
use App\Models\Author;

class Article extends BaseController
{
    public function __invoke()
    {
        $this->view->authors = Author::findAll();
        $article = \App\Models\Article::findById($_GET['id']);
        $this->view->article = $article;
        if (empty($article)) {
            $e = new NotFound404('Не существует записи с id = ' . $_GET['id']);
            Logger::instance()->error($e);
            throw $e;
        }
        $this->view->display(__DIR__ . '/../../../Templates/Admin/article.php');
    }
}
