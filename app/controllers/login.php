<?php

class login extends Controller
{
    public function index()
    {
        // If already logged in, redirect to dashboard
        if (isset($_SESSION['user_id'])) {
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
            header('Location: ' . $baseUrl . '/dashboard');
            exit;
        }

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');
            $user = $userModel->authenticate($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
                header('Location: ' . $baseUrl . '/dashboard');
                exit;
            } else {
                $data['error'] = 'Invalid username or password';
            }
        }

        $this->view('auth/login', $data);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        header('Location: ' . $baseUrl . '/login');
        exit;
    }
}
