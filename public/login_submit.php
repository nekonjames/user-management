<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Database\Connection;
use App\Model\UserModel;
use App\Service\AuthService;

$userModel = new UserModel(Connection::getConnection());
$auth = new AuthService($userModel);

$result = $auth->login($_POST['email'], $_POST['password']);

if (!$result['success']) {
    $_SESSION['error'] = $result['error'];
    header("Location: login.php");
    exit;
}

$_SESSION['user_id'] = $result['user']['id'];

header("Location: users.php");
exit;