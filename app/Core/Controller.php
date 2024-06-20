<?php

namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . "/../Views/$view.php";
        $layoutPath = __DIR__ . "/../Views/layouts/main.php";
        $view = $viewPath;
        include($layoutPath);
    }

    protected function model($model)
    {
        require_once __DIR__ . '/../Models/' . $model . '.php';
        return new $model();
    }
}
