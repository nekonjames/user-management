<?php
namespace App\Validation;
class UserValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['username'])) {
            $errors[] = 'Username is required';
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }

        if (strlen($data['password'] ?? '') < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }

        return $errors;
    }
}