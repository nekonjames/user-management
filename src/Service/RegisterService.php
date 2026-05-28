<?php
namespace App\Service;

use App\Model\UserModel;
use App\Validation\UserValidator;

class RegisterService
{
    public function __construct(
        private UserModel $userModel,
        private UserValidator $validator
    ) {}

    public function register(array $data): array
    {
        $errors = $this->validator->validate($data);

        if ($errors) {
            return ['success' => false, 'errors' => $errors];
        }

        $emailExist = $this->userModel->findByEmail($data['email']);
        if ($emailExist) {
            return ['success' => false, 'errors' => ['Email already exists']];
        }

        $usernameExist = $this->userModel->findByUsername($data['username']);
        if ($usernameExist) {
            return ['success' => false, 'errors' => ['Username already exists']];
        }

        $hashed = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->userModel->create(
            $data['username'],
            $data['email'],
            $hashed
        );

        return ['success' => true];
    }
}