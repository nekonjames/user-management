<?php
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

        $hashed = password_hash($data['password'], PASSWORD_BCRYPT);

        $this->userModel->create(
            $data['username'],
            $data['email'],
            $hashed
        );

        return ['success' => true];
    }
}