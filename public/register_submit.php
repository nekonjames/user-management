<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) ) {
    $_SESSION['error'] = "Invalid Request";
    header("Location: register.php");
    exit;
}

use App\Model\UserModel;
use App\Service\RegisterService;
use App\Validation\UserValidator;
use App\Database\Connection;

$userValidator = new UserValidator();
$userModel = new UserModel(Connection::getConnection());


$registerService = new RegisterService($userModel, $userValidator);

$result = $registerService->register($_POST);

if (!$result['success']) {
    $_SESSION['error'] = implode(', ', $result['errors']);;
    header("Location: register.php");
    exit;
}
$_SESSION['success'] = "Your account has been created. login to continue.";
header("Location: login.php");
exit;