<?php

use App\Model\UserModel;
use App\Service\AuthService;
use App\Validation\UserValidator;

class AuthServiceTest extends PHPUnit\Framework\TestCase
{
    public function test_failed_login()
    {
        $userModel = $this->createMock(UserModel::class);

        $userModel->method('findByEmail')
            ->willReturn([
                'id' => 1,
                'email' => 'sean-email@gmail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT)
            ]);

        $service = new AuthService($userModel, new UserValidator());

        $result = $service->login('sean-email@gmail.com', '12345678');

        $this->assertFalse($result['success']);
        $this->assertContains('Invalid Login Credentials', $result);
    }
}