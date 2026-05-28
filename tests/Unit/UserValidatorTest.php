<?php
use App\Validation\UserValidator;

class UserValidatorTest extends PHPUnit\Framework\TestCase
{
    public function test_invalid_email()
    {
        $validator = new UserValidator();

        $errors = $validator->validate([
            'username' => 'Sean',
            'email' => 'sean-email',
            'password' => '123456'
        ]);

        $this->assertContains('Invalid email format', $errors);
    }

    public function test_invalid_password()
    {
        $validator = new UserValidator();

        $errors = $validator->validate([
            'username' => 'Sean',
            'email' => 'sean-email@gmail.com',
            'password' => '1234'
        ]);

        $this->assertContains('Password must be at least 6 characters', $errors);
    }

    public function test_required_username()
    {
        $validator = new UserValidator();

        $errors = $validator->validate([
            'username' => '',
            'email' => 'sean-email@gmail.com',
            'password' => '123456'
        ]);

        $this->assertContains('Username is required', $errors);
    }
}