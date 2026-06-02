<?php

class dashboard extends Controller
{
    public $middlewares = ['AuthMiddleware'];

    public function index()
    {
        $data = [
            'username' => $_SESSION['username'] ?? 'User'
        ];
        $this->view('dashboard/index', $data, 'layoutmaster');
    }
}
