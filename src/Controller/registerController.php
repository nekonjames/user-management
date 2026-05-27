<?php
require '../Model/UserModel.php';
require '../Service/RegisterService.php';
require '../Validation/UserValidator.php';
require '../Database/Connection.php';

session_start();
$userModel = new UserModel(Connection::getConnection());
$userValidator = new UserValidator();

$registerService = new RegisterService($userModel, $userValidator);

$result = $registerService->register($_POST);

if (!$result['success']) {
    $_SESSION['error'] = implode(', ', $result['errors']);;
    header("Location: ../../public/register.php");
    exit;
}

header("Location: ../../public/login.php");