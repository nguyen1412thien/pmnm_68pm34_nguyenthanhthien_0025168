<?php

class Controller
{
    public function model($model)
    {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        }
        return false;
    }

    public function view($view, $data = [], $layout = '')
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            if ($layout && file_exists('../app/views/layouts/' . $layout . '.php')) {
                ob_start();
                require_once '../app/views/' . $view . '.php';
                $content = ob_get_clean();
                require_once '../app/views/layouts/' . $layout . '.php';
            } else {
                require_once '../app/views/' . $view . '.php';
            }
        }
    }
}
