<?php

namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }

    protected function model($model)
    {
        require_once __DIR__ . '/../Models/' . $model . '.php';
        return new $model();
    }
}
