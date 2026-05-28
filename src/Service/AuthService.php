<?php
namespace App\Service;
use App\Model\UserModel;

class AuthService
{
    public function __construct(
        private UserModel $userModel
    ) {}

    public function login(string $email, string $password): array
    {
        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return ['success' => false, 'error' => 'Invalid Login Credentials'];
        }

        return ['success' => true, 'user' => $user];
    }
}