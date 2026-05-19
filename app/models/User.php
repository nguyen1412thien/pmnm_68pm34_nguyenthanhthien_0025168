<?php

class User
{
    // Hardcoded user for demonstration purposes
    private $users = [
        [
            'id' => 1,
            'username' => 'admin',
            'password' => 'password123' // In a real app, use password_hash and password_verify
        ]
    ];

    public function authenticate($username, $password)
    {
        foreach ($this->users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                return $user;
            }
        }
        return false;
    }
}
