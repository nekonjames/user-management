<?php
namespace App\Service;

use App\Database\Connection;
use App\Model\UserModel;

class UserService
{
    static function getAllUsers(): array
    {
        $userModel =  new UserModel(Connection::getConnection());
        return $userModel->loadAll();
    }
}
