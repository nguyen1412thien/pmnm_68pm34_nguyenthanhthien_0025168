<?php

class home extends Controller
{
    public function index()
    {
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header('Location: ' . $baseUrl . '/login');
        exit;
    }
}