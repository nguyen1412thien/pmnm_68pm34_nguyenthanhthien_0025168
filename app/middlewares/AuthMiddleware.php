<?php

class AuthMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION['user_id'])) {
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseUrl . '/login');
            exit;
        }
    }
}
